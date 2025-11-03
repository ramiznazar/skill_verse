<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Models\Batch;
use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;


class BatchController extends Controller
{
    public function index(Request $request)
    {
        $query = Batch::with(['course', 'teacher'])->orderBy('start_date', 'desc');

        $search = trim((string) $request->get('search'));
        $courseId = $request->get('course_id');
        $status = $request->get('status');
        $shift = $request->get('shift');

        // 🔎 Search filter
        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhereHas('course', fn($c) => $c->where('title', 'like', "%{$search}%"))
                    ->orWhereHas('teacher', fn($t) => $t->where('name', 'like', "%{$search}%"));
            });
        }

        // 🎯 Course filter
        if (!empty($courseId)) {
            $query->where('course_id', $courseId);
        }

        // 🎯 Status filter
        if (!empty($status)) {
            $query->where('status', $status);
        }

        // 🎯 Shift filter
        if (!empty($shift)) {
            $query->where('shift', $shift);
        }

        $batches = $query->paginate(15)->withQueryString();

        $courses = Course::whereHas('batch')
            ->select('id', 'title')
            ->orderBy('title')
            ->get();

        return view('admin.pages.dashboard.batch.index', compact('batches', 'courses'));
    }

    public function create()
    {
        $courses = Course::all();
        $teachers = Teacher::where('status', 'active')->get();
        return view('admin.pages.dashboard.batch.create', compact('courses', 'teachers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'teacher_id' => 'required|exists:teachers,id',
            'title' => 'nullable|string|max:255',
            'timing' => 'nullable|string|max:255',
            'shift' => 'required|in:morning,evening,night',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'required',
            'capacity' => 'nullable|integer|min:0',
            'note' => 'nullable|string',
        ]);

        Batch::create($request->all());

        return redirect()->route('batch.index')->with('store', 'Batch created successfully.');
    }

    public function edit(string $id)
    {
        $batch = Batch::findOrFail($id);
        $courses = Course::all();
        $teachers = Teacher::where('status', 'active')->get();
        return view('admin.pages.dashboard.batch.update', compact('batch', 'courses', 'teachers'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'teacher_id' => 'required|exists:teachers,id',
            'title' => 'nullable|string|max:255',
            'timing' => 'nullable|string|max:255',
            'shift' => 'required|in:morning,evening,night',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'required',
            'capacity' => 'nullable|integer|min:0',
            'note' => 'nullable|string',
        ]);

        $batch = Batch::findOrFail($id);
        $batch->update($request->all());

        return redirect()->route('batch.index')->with('update', 'Batch updated successfully.');
    }

    public function destroy(string $id)
    {
        $batch = Batch::findOrFail($id);
        $batch->delete();

        return redirect()->route('batch.index')->with('delete', 'Batch deleted successfully.');
    }

    public function getByCourse($courseId)
    {
        try {
            $batches = Batch::with('course:id,title,min_fee')
                ->where('course_id', $courseId)
                ->get(['id', 'title', 'shift', 'course_id']);

            return response()->json($batches);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
