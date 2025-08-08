<?php

namespace App\Http\Controllers\Admin\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserMessage;

class UserMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages = UserMessage::all();
        return view('admin.pages.website.user-message',compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $message = UserMessage::find($id);
        $message->delete();
        return redirect()->route('message.index')->with('delete','Record Deleted Successfully!');
    }
}
