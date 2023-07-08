<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Models\AuthUser;
use App\Models\PasswordReset;
use App\Mail\ResetPassword;
use Validator;

class ForgotPasswordController extends Controller
{
    //
    public function forgotPassword()
    {
       
        return view('auth.forgot_password');
    }
    public function submitForgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'exists:auth_users'

        ]);
      

        if ($validator->fails()) {

            return back()->with('fail', 'Email not exist');
        } else {
            
            $token = Str::random(64);
            $reset_pss = new PasswordReset();
            $reset_pss->email = $request->email;
            $reset_pss->token = $token;
            $reset_pss->created_at = Carbon::now();
           
            $reset_pss->save();

            Mail::to($reset_pss['email'])->send(new ResetPassword($reset_pss));
            return back()->with('message', 'We have emailed reset password link');
        }

        // return back()->with('message', 'We have emailed reset password link');
    }


//     public function resetPassword($token)
//     {  
//         $rst_pswrd = PasswordReset::find($id);
//         $expiry  = Carbon::now()->subMinutes(60);
       
// //                 if ($rst_pswrd->created_at <= $expiry) {
// //                     return redirect('/forgot-password')->with('fail', 'Link Expired please enter your email again and submit');
// //                 }
// //                 // else if($rst_pswrd->created_at == "") {
// //                 // dd('ddd');die();
// //                 // }

// //    else{
//     return view('auth.reset_password', compact('rst_pswrd'));
// //    }
    
// }

public function resetPassword($token) 
{
    $rst_pswrd = PasswordReset::where('token',$token)->first();
        $expiry  = Carbon::now()->subMinutes(10);
        
               if($rst_pswrd==""){
                return redirect('/forgot-password')->with('fail', 'Link Expired ');
               }
              else if ($rst_pswrd->created_at <= $expiry) {
                    return redirect('/forgot-password')->with('fail', 'Link Expired please enter your email again and submit');
                }      
                
                else{
                return view('auth.reset_password',compact('token','rst_pswrd'));
                    }
}


    public function submitResetPassword(Request $request)
    {
       
        $updatePassword = DB::table('password_resets')->where([
            'email' => $request->email,
            'token' => $request->token,
             ])->first();

        

        if (!$updatePassword ) {
            return back()->withInput()->with('error', 'Invalid token!');
        } 

    $user = AuthUser::where('email', $request->email)->update(['password' => Hash::make($request->password)]);

    DB::table('password_resets')->where(['email' => $request->email])->delete();

    return redirect('/login')->with('message', 'Your password has been changed!');
            
            
    }
}
