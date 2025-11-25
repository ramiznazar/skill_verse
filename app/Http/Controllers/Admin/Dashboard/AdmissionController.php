<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Models\Lead;
use App\Models\User;
use App\Models\Batch;
use App\Models\Course;
use App\Models\Admission;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\TestBooking;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AdmissionController extends Controller
{

    public function index(Request $request)
    {
        $query = Admission::with(['courses', 'batches', 'course', 'batch'])
            ->orderByDesc('joining_date');

        // 🔎 Search
        if ($search = trim($request->get('search'))) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhereHas('course', fn($c) => $c->where('title', 'like', "%{$search}%"))
                    ->orWhereHas('batch', fn($b) => $b->where('title', 'like', "%{$search}%"))
                    ->orWhereHas('courses', fn($c) => $c->where('title', 'like', "%{$search}%"))
                    ->orWhereHas('batches', fn($b) => $b->where('title', 'like', "%{$search}%"));
            });
        }

        // Filters
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('student_status', $request->status);
        }

        if ($request->filled('course_id')) {
            $query->where(function ($q) use ($request) {
                $q->where('course_id', $request->course_id)
                    ->orWhereHas('courses', fn($c) => $c->where('courses.id', $request->course_id));
            });
        }

        if ($request->filled('batch_id')) {
            $query->where(function ($q) use ($request) {
                $q->where('batch_id', $request->batch_id)
                    ->orWhereHas('batches', fn($b) => $b->where('batches.id', $request->batch_id));
            });
        }

        if ($request->filled('payment')) {
            $query->where('payment_type', $request->payment);
        }

        $admissions = $query->paginate(15)->withQueryString();

        $totalStudents = Admission::count();
        $activeStudents = Admission::where('student_status', 'active')->count();

        $courses = Course::select('id', 'title')->orderBy('title')->get();
        $batches = Batch::select('id', 'title')->orderBy('title')->get();

        return view('admin.pages.dashboard.admission.index', compact(
            'admissions',
            'totalStudents',
            'activeStudents',
            'courses',
            'batches'
        ));
    }

    public function create(Request $request)
    {
        $lead = null;
        $prefill = null;

        if ($request->has('lead_id')) {
            $lead = Lead::find($request->lead_id);
        }
        if ($request->has('booking_id')) {
            $prefill = TestBooking::with(['course', 'batch'])->find($request->booking_id);
        }

        $courses = Course::all();
        $batches = Batch::all();
        return view('admin.pages.dashboard.admission.create', compact('lead', 'courses', 'batches','prefill'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_ids' => 'required|array|min:1',
            'course_ids.*' => 'exists:courses,id',
            'batch_ids' => 'required|array|min:1',
            'batch_ids.*' => 'exists:batches,id',
            'course_fees' => 'nullable|array',
            'course_fees.*' => 'nullable|numeric|min:0',

            'image' => 'nullable|image',
            'name' => 'required|string|max:255',
            'mode' => 'required|in:physical,online',
            'online_percentage' => 'nullable|required_if:mode,online|integer|min:0|max:100',
            'guardian_name' => 'nullable|string|max:255',
            'guardian_contact' => 'nullable|string|max:20',
            'cnic' => 'nullable|string|max:20',
            'dob' => 'nullable|date',
            'email' => 'nullable|email|max:255',
            'phone' => 'required|string|max:20',
            'joining_date' => 'nullable|date',
            'student_status' => 'required',
            'gender' => 'nullable|in:male,female',
            'qualification' => 'nullable|string|max:100',
            'last_institute' => 'nullable|string|max:255',
            'referral_source' => 'nullable|string|max:255',
            'referral_source_contact' => 'nullable|string|max:255',
            'referral_source_commission' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'referral_type' => 'nullable|in:ads,referral,other',

            'payment_type' => 'required|in:full_fee,installment',
            'full_fee' => 'required|numeric|min:0',

            'installment_count' => 'nullable|in:2,3',
            'installment_1' => 'nullable|numeric|min:0',
            'installment_2' => 'nullable|numeric|min:0',
            'installment_3' => 'nullable|numeric|min:0',
            'apply_additional_charges' => 'nullable|boolean',
        ]);

        $fullFee = (int) $request->full_fee;

        // extra guard: arrays same length
        if (
            count($request->course_ids) !== count($request->batch_ids) ||
            count($request->course_ids) !== count($request->course_fees)
        ) {
            return back()->withInput()->withErrors([
                'course_ids' => 'Courses, batches and fees counts must match.'
            ]);
        }

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('assets/admin/images/code/admission/'), $imageName);
            $imagePath = 'assets/admin/images/code/admission/' . $imageName;
        }

        // Validate installments
        if ($request->payment_type === 'installment') {
            $count = (int) $request->input('installment_count', 3);
            $count = in_array($count, [2, 3], true) ? $count : 3;

            $base = (int) $request->input('full_fee', 0);
            $applyExtra = $request->boolean('apply_additional_charges');
            $extra = $applyExtra ? (1000 * $count) : 0;

            $inst1 = (int) $request->input('installment_1', 0);
            $inst2 = (int) $request->input('installment_2', 0);
            $inst3 = $count === 3 ? (int) $request->input('installment_3', 0) : 0;

            $sum = $inst1 + $inst2 + $inst3;
            $expected = $base + $extra;

            if ($sum !== $expected) {
                return back()->withInput()->withErrors([
                    'installment_1' => "Installment total must equal full fee + extras (expected: {$expected})."
                ]);
            }
        } else {
            $request->merge([
                'installment_count' => null,
                'installment_1' => 0,
                'installment_2' => 0,
                'installment_3' => 0,
                'apply_additional_charges' => false,
            ]);
        }

        DB::transaction(function () use ($request, $imagePath) {

            // roll number
            $lastRollNo = Admission::max('roll_no');
            $newRollNo = $lastRollNo ? $lastRollNo + 1 : 1;

            // legacy fill: use first course/batch for backward compatibility
            $firstCourseId = $request->course_ids[0] ?? null;
            $firstBatchId = $request->batch_ids[0] ?? null;

            $admission = Admission::create([
                'course_id' => $firstCourseId, // keep legacy columns populated
                'batch_id' => $firstBatchId,  // keep legacy columns populated

                'roll_no' => $newRollNo,
                'image' => $imagePath,
                'name' => $request->name,
                'mode' => $request->mode,
                'online_percentage' => $request->online_percentage,
                'guardian_name' => $request->guardian_name,
                'guardian_contact' => $request->guardian_contact,
                'cnic' => $request->cnic,
                'dob' => $request->dob,
                'email' => $request->email,
                'phone' => $request->phone,
                'joining_date' => $request->joining_date,
                'student_status' => $request->student_status,
                'gender' => $request->gender,
                'qualification' => $request->qualification,
                'last_institute' => $request->last_institute,
                'referral_source' => $request->referral_source,
                'referral_source_contact' => $request->referral_source_contact,
                'referral_source_commission' => $request->referral_source_commission,
                'address' => $request->address,
                'referral_type' => $request->referral_type,

                'payment_type' => $request->payment_type,
                'full_fee' => (int) $request->full_fee,
                'installment_1' => (int) $request->installment_1,
                'installment_2' => (int) $request->installment_2,
                'installment_3' => (int) $request->installment_3,
            ]);

            // pivot inserts
            foreach ($request->course_ids as $i => $courseId) {
                $batchId = $request->batch_ids[$i] ?? null;
                if ($request->payment_type === 'full_fee') {
                    $fee = (int) $request->full_fee;
                } else {
                    $fee = $request->course_fees[$i] ?? $request->full_fee;
                    $fee = (is_numeric($fee) && $fee > 0) ? (int) $fee : (int) $request->full_fee;
                }

                if ($batchId) {
                    DB::table('admission_course_batch')->insert([
                        'admission_id' => $admission->id,
                        'course_id' => $courseId,
                        'batch_id' => $batchId,
                        'course_fee' => $fee,
                        'payment_type' => $request->payment_type,
                        'installment_count' => $request->installment_count,
                        'installment_1' => $request->installment_1,
                        'installment_2' => $request->installment_2,
                        'installment_3' => $request->installment_3,
                        'apply_additional_charges' => $request->boolean('apply_additional_charges'),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

            // notification (unchanged)
            $notification = Notification::create([
                'title' => 'New Admission',
                'message' => "Student {$admission->name} admitted.",
                'icon' => 'fa fa-user',
                'type' => 'admission',
                'status' => 1,
            ]);

            $targetRoles = ['admin', 'administrator', 'partner'];
            $userIds = User::whereIn('role', $targetRoles)->pluck('id');

            if ($userIds->isNotEmpty()) {
                $now = now();
                $attach = [];
                foreach ($userIds as $uid) {
                    $attach[$uid] = ['is_read' => false, 'created_at' => $now, 'updated_at' => $now];
                }
                $notification->users()->syncWithoutDetaching($attach);
            }
        });

        return redirect()->route('admission.index')->with('store', 'Admission created successfully.');
    }

    public function show(string $id)
    {
        $admission = Admission::with(['course', 'batch'])->findOrFail($id);

        return view('admin.pages.dashboard.admission.show', compact('admission'));
    }

    public function edit($id)
    {
        $admission = Admission::findOrFail($id);

        // Infer installment count and additional charge info
        $preCount = ($admission->installment_3 ?? 0) > 0 ? 3 : 2;
        $savedFee = (int) $admission->full_fee;
        $inst1 = (int) $admission->installment_1;
        $inst2 = (int) $admission->installment_2;
        $inst3 = (int) ($preCount === 3 ? $admission->installment_3 : 0);
        $sumInst = $inst1 + $inst2 + $inst3;
        $expectedIfExtra = $savedFee + (1000 * $preCount);
        $applyExtraDefault = ($sumInst === $expectedIfExtra);

        $courses = Course::all();
        $batches = Batch::all();

        return view('admin.pages.dashboard.admission.update', compact(
            'admission',
            'courses',
            'batches',
            'preCount',
            'applyExtraDefault'
        ));
    }

    public function update(Request $request, $id)
    {
        $admission = Admission::findOrFail($id);

        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'batch_id' => 'required|exists:batches,id',
            'image' => 'nullable|image',
            'name' => 'required|string|max:255',
            'mode' => 'required|in:physical,online',
            'online_percentage' => 'nullable|required_if:mode,online|integer|min:0|max:100',
            'guardian_name' => 'nullable|string|max:255',
            'guardian_contact' => 'nullable|string|max:20',
            'cnic' => 'nullable|string|max:20',
            'dob' => 'nullable|date',
            'email' => 'nullable|email|max:255',
            'phone' => 'required|string|max:20',
            'joining_date' => 'nullable|date',
            'student_status' => 'required',
            'gender' => 'nullable|in:male,female',
            'qualification' => 'nullable|string|max:100',
            'last_institute' => 'nullable|string|max:255',
            'referral_source' => 'nullable|string|max:255',
            'referral_source_contact' => 'nullable|string|max:255',
            'referral_source_commission' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'referral_type' => 'nullable|in:ads,referral,other',
            'payment_type' => 'required|in:full_fee,installment',
            'full_fee' => 'required|numeric|min:0',
            'installment_count' => 'nullable|in:2,3',
            'installment_1' => 'nullable|numeric|min:0',
            'installment_2' => 'nullable|numeric|min:0',
            'installment_3' => 'nullable|numeric|min:0',
            'apply_additional_charges' => 'nullable|boolean',
        ]);

        // ----- Payment Type Logic -----
        if ($request->payment_type === 'installment') {
            $count = (int) $request->input('installment_count', 3);
            $count = in_array($count, [2, 3]) ? $count : 3;
            $base = (int) $request->input('full_fee', 0);
            $applyExtra = $request->boolean('apply_additional_charges');
            $extra = $applyExtra ? (1000 * $count) : 0;

            $inst1 = (int) $request->input('installment_1', 0);
            $inst2 = (int) $request->input('installment_2', 0);
            $inst3 = $count === 3 ? (int) $request->input('installment_3', 0) : 0;

            $sum = $inst1 + $inst2 + $inst3;
            $expected = $base + $extra;

            if ($sum !== $expected) {
                return back()->withInput()->withErrors([
                    'installment_1' => "Installment total must equal full fee + extras (expected: {$expected})."
                ]);
            }
        } else {
            $request->merge([
                'installment_count' => null,
                'installment_1' => 0,
                'installment_2' => 0,
                'installment_3' => 0,
                'apply_additional_charges' => false,
            ]);
        }

        // ----- Image Upload -----
        if ($request->hasFile('image')) {
            if ($admission->image && file_exists(public_path($admission->image))) {
                @unlink(public_path($admission->image));
            }
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('assets/admin/images/code/admission/'), $imageName);
            $admission->image = 'assets/admin/images/code/admission/' . $imageName;
        }

        // ----- Update Admission Record -----
        $admission->update([
            'course_id' => $request->course_id,
            'batch_id' => $request->batch_id,
            'name' => $request->name,
            'mode' => $request->mode,
            'online_percentage' => $request->online_percentage,
            'guardian_name' => $request->guardian_name,
            'guardian_contact' => $request->guardian_contact,
            'cnic' => $request->cnic,
            'dob' => $request->dob,
            'email' => $request->email,
            'phone' => $request->phone,
            'joining_date' => $request->joining_date,
            'student_status' => $request->student_status,
            'gender' => $request->gender,
            'qualification' => $request->qualification,
            'last_institute' => $request->last_institute,
            'referral_source' => $request->referral_source,
            'referral_source_contact' => $request->referral_source_contact,
            'referral_source_commission' => $request->referral_source_commission,
            'address' => $request->address,
            'referral_type' => $request->referral_type,
            'payment_type' => $request->payment_type,
            'full_fee' => (int) $request->full_fee,
            'installment_1' => (int) $request->installment_1,
            'installment_2' => (int) $request->installment_2,
            'installment_3' => (int) $request->installment_3,
        ]);

        // ----- 🔹 Sync Pivot Table (this fixes Fee Submission issue) -----
        $courseId = $request->course_id;

        if ($admission->courses()->where('course_id', $courseId)->exists()) {
            $admission->courses()->updateExistingPivot($courseId, [
                'course_fee'    => (int) $request->full_fee,
                'installment_1' => (int) $request->installment_1,
                'installment_2' => (int) $request->installment_2,
                'installment_3' => (int) $request->installment_3,
                'payment_type'  => $request->payment_type,
            ]);
        } else {
            $admission->courses()->attach($courseId, [
                'course_fee'    => (int) $request->full_fee,
                'installment_1' => (int) $request->installment_1,
                'installment_2' => (int) $request->installment_2,
                'installment_3' => (int) $request->installment_3,
                'payment_type'  => $request->payment_type,
            ]);
        }

        return redirect()->route('admission.index')->with('update', 'Admission updated successfully.');
    }

    public function destroy(string $id)
    {
        $admission = Admission::findOrFail($id);

        if (!empty($admission->image)) {
            // e.g., 'assets/admin/images/code/admission/foo.jpg' OR 'admissions/foo.jpg'
            // Adjust path according to how you saved it
            Storage::disk('public')->delete($admission->image);
        }

        $admission->delete();

        return redirect()->route('admission.index')->with('delete', 'Admission deleted successfully!');
    }

    // add new course 
    public function addCourseForm($admissionId)
    {
        $admission = Admission::with(['courses', 'batches'])->findOrFail($admissionId);
        $courses = Course::all();
        $batches = Batch::all();

        return view('admin.pages.dashboard.admission.add-new-course', compact('admission', 'courses', 'batches'));
    }

    public function storeNewCourse(Request $request, $admissionId)
    {
        $admission = Admission::findOrFail($admissionId);

        // ✅ Validate input
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'batch_id' => 'required|exists:batches,id',
            'course_fee' => 'required|numeric|min:0',
            'payment_type' => 'required|in:full_fee,installment',
            'installment_count' => 'nullable|in:2,3',
            'installment_1' => 'nullable|numeric|min:0',
            'installment_2' => 'nullable|numeric|min:0',
            'installment_3' => 'nullable|numeric|min:0',
            'apply_additional_charges' => 'nullable|boolean',
        ]);

        // ✅ validate installments if selected
        if ($request->payment_type === 'installment') {
            $count = (int) $request->installment_count;
            $base = (int) $request->course_fee;
            $applyExtra = $request->boolean('apply_additional_charges');
            $extra = $applyExtra ? (1000 * $count) : 0;

            $inst1 = (int) $request->installment_1;
            $inst2 = (int) $request->installment_2;
            $inst3 = $count === 3 ? (int) $request->installment_3 : 0;
            $sum = $inst1 + $inst2 + $inst3;
            $expected = $base + $extra;

            if ($sum !== $expected) {
                return back()->withInput()->withErrors([
                    'installment_1' => "Installments must total to ₨{$expected} (course fee + extras)."
                ]);
            }
        }

        // ✅ Save everything in admission_course_batch (no separate installments table)
        DB::table('admission_course_batch')->insert([
            'admission_id' => $admission->id,
            'course_id' => $request->course_id,
            'batch_id' => $request->batch_id,
            'course_fee' => $request->course_fee,
            'payment_type' => $request->payment_type,
            'installment_count' => $request->installment_count,
            'installment_1' => $request->installment_1,
            'installment_2' => $request->installment_2,
            'installment_3' => $request->installment_3,
            'apply_additional_charges' => $request->has('apply_additional_charges'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        return redirect()
            ->route('admission.index')
            ->with('store', 'New course added successfully!');
    }

    public function editCourse($admissionId, $courseId)
    {
        $admission = Admission::findOrFail($admissionId);
        $course = $admission->courses()->where('course_id', $courseId)->firstOrFail();
        $pivot = $course->pivot;
        $batches = Batch::all();
        $courses = Course::all();

        return view('admin.pages.dashboard.admission.edit-new-course', compact('admission', 'course', 'pivot', 'courses', 'batches'));
    }

    public function updateCourse(Request $request, $admissionId, $courseId)
    {
        $admission = Admission::findOrFail($admissionId);

        $validated = $request->validate([
            'batch_id' => 'required|exists:batches,id',
            'course_fee' => 'required|numeric|min:0',
            'payment_type' => 'required|in:full_fee,installment',
            'installment_count' => 'nullable|in:2,3',
            'installment_1' => 'nullable|numeric|min:0',
            'installment_2' => 'nullable|numeric|min:0',
            'installment_3' => 'nullable|numeric|min:0',
            'apply_additional_charges' => 'nullable|boolean',
        ]);

        $admission->courses()->updateExistingPivot($courseId, [
            'batch_id' => $validated['batch_id'],
            'course_fee' => $validated['course_fee'],
            'payment_type' => $validated['payment_type'],
            'installment_count' => $validated['installment_count'] ?? null,
            'installment_1' => $validated['installment_1'] ?? 0,
            'installment_2' => $validated['installment_2'] ?? 0,
            'installment_3' => $validated['installment_3'] ?? 0,
            'apply_additional_charges' => $request->has('apply_additional_charges'),
        ]);

        return redirect()->route('admission.index')->with('update', 'Course updated successfully!');
    }
}
