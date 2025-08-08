<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teacher;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::all();
        return view('admin.pages.dashboard.teacher.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.dashboard.teacher.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'name'          => 'required|string|max:255',
            'email'         => 'nullable|email|unique:teachers,email',
            'phone'         => 'required|string|max:20',
            'qualification' => 'nullable|string|max:255',
            'skill'         => 'required|string|max:255',
            'experience'    => 'required|string|max:255',
            'salary'        => 'nullable|string|max:255',
            'joining_date'  => 'nullable|date',
            'status'        => 'nullable|in:active,inactive',
            'notes'         => 'nullable|string',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = 'assets/admin/images/code/teacher/' . $imageName;
            $image->move(public_path('assets/admin/images/code/teacher/'), $imageName);
        }

        Teacher::create([
            'image'         => $imagePath,
            'name'          => $request->name,
            'email'         => $request->email,
            'phone'         => $request->phone,
            'qualification' => $request->qualification,
            'skill'         => $request->skill,
            'experience'    => $request->experience,
            'salary'        => $request->salary,
            'joining_date'  => $request->joining_date,
            'status'        => $request->status,
            'notes'         => $request->notes,
        ]);

        return redirect()->route('teacher.index')->with('store', 'Teacher added successfully.');
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
        $teacher = Teacher::findOrFail($id);
        return view('admin.pages.dashboard.teacher.update', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'name'          => 'required|string|max:255',
            'email'         => 'nullable|email|unique:teachers,email,' . $id,
            'phone'         => 'required|string|max:20',
            'qualification' => 'nullable|string|max:255',
            'skill'         => 'required|string|max:255',
            'experience'    => 'required|string|max:255',
            'salary'        => 'nullable|string|max:255',
            'joining_date'  => 'nullable|date',
            'status'        => 'nullable|in:active,inactive',
            'notes'         => 'nullable|string',
        ]);

        $teacher = Teacher::findOrFail($id);

        // Handle Image Upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($teacher->image) {
                $oldImagePath = public_path($teacher->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = 'assets/admin/images/code/teacher/' . $imageName;
            $image->move(public_path('assets/admin/images/code/teacher/'), $imageName);

            $teacher->image = $imagePath;
        }

        // Update other fields
        $teacher->name          = $request->name;
        $teacher->email         = $request->email;
        $teacher->phone         = $request->phone;
        $teacher->qualification = $request->qualification;
        $teacher->skill         = $request->skill;
        $teacher->experience    = $request->experience;
        $teacher->salary        = $request->salary;
        $teacher->joining_date  = $request->joining_date;
        $teacher->status        = $request->status;
        $teacher->notes         = $request->notes;

        $teacher->save();

        return redirect()->route('teacher.index')->with('update', 'Teacher updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $teacher = Teacher::find($id);
        $imagePath = public_path($teacher->image);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
        $teacher->delete();
        return redirect()->route('teacher.index')->with('delete', 'Course deleted successfully!');
    }
}
