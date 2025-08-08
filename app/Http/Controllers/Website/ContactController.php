<?php

namespace App\Http\Controllers\Website;

use App\Models\UserMessage;
use Illuminate\Http\Request;
use App\Models\PopularCourse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserMessageMail;

class ContactController extends Controller
{
    public function contact(){
        $popularCourses = PopularCourse::all();
        return view('website.pages.contact',compact('popularCourses'));
    }
    public function userMessage(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'nullable|email|max:255',
            'address'   => 'required|string|max:255',
            'phone'   => 'required|string|max:255',
            'message' => 'required|string',
        ]);    
        UserMessage::create([
            'name'    => $request->name,
            'email'   => $request->email,
            'address'   => $request->address,
            'phone'   => $request->phone,
            'message' => $request->message,
        ]);
        //Send Email th the User1
        Mail::to($request->email)->send(new UserMessageMail($request->all()));
    
        return redirect()->back()->with(['success' => 'Your message has been received. Our team will review it and respond as soon as possible. Thank you for reaching out!']);
    }
}
