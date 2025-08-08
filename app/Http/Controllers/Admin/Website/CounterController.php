<?php

namespace App\Http\Controllers\Admin\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Counter;

class CounterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $counters = Counter::all();
        return view('admin.pages.website.counter.index',compact('counters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.website.counter.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'title' => 'nullable|string',
            'number' => 'nullable',
            'icon_class' => 'nullable',
        ]);
        Counter::create($validate);
        return redirect()->route('counter.index')->with('store','Counter Added Successfully');
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
        $counter = Counter::findOrFail($id);
        return view('admin.pages.website.counter.update',compact('counter'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
            'title' => 'nullable|string',
            'number' => 'nullable',
            'icon_class' => 'nullable',
        ]);
        $counter = Counter::findOrFail($id);
        $counter->title = $request->title;
        $counter->number = $request->number;
        $counter->icon_class = $request->icon_class;
        $counter->save();
        return redirect()->route('counter.index')->with('update','Counter Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $counter = Counter::findOrFail($id);
        $counter->delete();
        return redirect()->back()->with('delete','Counter Deleted Successfully');
    }
}
