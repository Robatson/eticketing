<?php

namespace App\Http\Controllers;

use App\Models\AddEvent;
use Illuminate\Http\Request;
use App\Models\AuthUser;
use Session;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //
    public function AdminDashboard(){
        if (session()->has('checkAdmin')) {

          
        return view('admin.main');
        }
    }
    public function viewEvent()
    {

        $event = AddEvent::all();

        return view('admin.view_event', compact('event'));
    }
    public function statusApproveReject(Request $request, $requestid, $event_status)
    {

        $evtstatus = AddEvent::where('id', $requestid)->first();
        $evtstatus->status = $event_status;
        $evtstatus->update();
        $actions = 'Event Status Updated Succesfully!!';
        return $actions;
    }

    public function login()
    {

        return view('auth.admin_login');
    }

    public function checkAdminLogin(Request $request)
    {

        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
         ],[
            'email.required' => 'Please Enter your Email ',
            'password.required' => 'Please Enter your Password',
            
          ]);
        $user = AuthUser::where('email', '=', $request->email)->where('status','=', 0)->first();
      
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                //if password match
                Session::put('checkAdmin',$user->id);
                

                return redirect('admin/dashboard');
            } else {
                return back()->with('fail', 'Invalid Password');
            }
        } else {
            return back()->with('fail', 'No account found ');
        }
        
        } 
        public function adminlogout()
        {
    
            if (session()->has('checkAdmin')) {
                session()->pull('checkAdmin');
                return redirect('admin/login');
            }
        }
    }