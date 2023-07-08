<?php

namespace App\Http\Controllers;

use App\Models\AddEvent;
use Illuminate\Http\Request;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;
class EventController extends Controller
{
    //
    public function addEvent(){

        return view('addEvent.add_event');
    }
    public function storeEvent(Request $request){
        
        $addevnt = new AddEvent ();
        $addevnt->first_name = $request->first_name;
        $addevnt->last_name = $request->last_name;
        $addevnt->email = $request->email;
        $addevnt->phone = $request->phone;
        $addevnt->start_date = $request->start_date;
        $addevnt->end_date = $request->end_date;
        $addevnt->event_name = $request->event_name;
        $addevnt->slug = \Str::slug($request->event_name);
        $addevnt->ticket_price = $request->ticket_price;
        $addevnt->description = $request->description;
        $addevnt->status = "On Hold";
        if ($request->hasfile('event_photo')){
            $file = $request->file('event_photo');
            $extension = $file->getClientOriginalExtension();
            $filename = md5(time()).'.'.$extension;
            $file->move(public_path().'\image\Event',$filename);
            $addevnt->event_photo=$filename;
        }
        $addevnt->save();
     

     Mail::to($addevnt['email'])->send(new SendMail($addevnt));
        
        if ($addevnt) {
            return redirect('/');

        } else {
            return back()->with('error', 'Something went wrong');
        }
    }
    public function display(){

        $event =AddEvent::where('status','Approved')->get();

        return view('homapage.homepage',compact('event'));
    }
    public function displayEventDetails($slug){

        $eventDetails =AddEvent::where('slug',$slug)->first();

        return view('addEvent.display_eventdetails_details',compact('eventDetails'));
    }
   
}
