<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Models\Lead;
use App\Models\Batch;
use App\Models\Course;
use App\Models\Admission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AdmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Admission::with(['course', 'batch'])->orderBy('joining_date', 'desc');

        // 🔎 Search
        $search = trim((string) $request->get('search'));
        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhereHas('course', fn($c) => $c->where('title', 'like', "%{$search}%"))
                    ->orWhereHas('batch', fn($b) => $b->where('title', 'like', "%{$search}%"));
            });
        }

        // filter
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('student_status', $request->status);
        }
        if ($request->filled('course_id')) {
            $query->where('course_id', $request->course_id);
        }
        if ($request->filled('batch_id')) {
            $query->where('batch_id', $request->batch_id);
        }
        if ($request->filled('payment')) {
            $query->where('payment_type', $request->payment);
        }

        $admissions = $query->paginate(15)->withQueryString();
        $totalStudents = $admissions->total();
        $activeStudents = Admission::where('student_status', 'active')->count();

        $courses = Course::whereHas('admissions')->select('id', 'title')->orderBy('title')->get();
        $batches = Batch::whereHas('admissions')->select('id', 'title')->orderBy('title')->get();

        return view('admin.pages.dashboard.admission.index', compact(
            'admissions',
            'totalStudents',
            'activeStudents',
            'courses',
            'batches'
        ));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $lead = null;

        if ($request->has('lead_id')) {
            $lead = Lead::find($request->lead_id);
        }
        $courses = Course::all();
        $batches = Batch::all();
        return view('admin.pages.dashboard.admission.create', compact('lead', 'courses', 'batches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate request
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'batch_id' => 'required|exists:batches,id',
            'image' => 'nullable|image',
            'name' => 'required|string|max:255',
            'guardian_name' => 'nullable|string|max:255',
            'guardian_contact' => 'nullable|string|max:20',
            'cnic' => 'nullable|string|max:20',
            'dob' => 'nullable|date',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'joining_date' => 'nullable|date',
            'student_status' => 'required',
            'gender' => 'nullable|in:male,female',
            'qualification' => 'nullable|string|max:100',
            'last_institute' => 'nullable|string|max:255',
            'referral_source' => 'nullable|string|max:255',
            'referral_source_contact' => 'nullable|string|max:255',
            'referral_source_commission' => 'nullable|string|max:255',
            'address' => 'nullable|string',

            'payment_type' => 'required|in:full_fee,installment',
            'full_fee' => 'required|numeric|min:0',

            // Installment-related
            'installment_count' => 'nullable|in:2,3',
            'installment_1' => 'nullable|numeric|min:0',
            'installment_2' => 'nullable|numeric|min:0',
            'installment_3' => 'nullable|numeric|min:0',
            'apply_additional_charges' => 'nullable',
            'referral_type' => 'nullable|in:ads,referral,other',
        ]);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('assets/admin/images/code/admission/'), $imageName);
            $imagePath = 'assets/admin/images/code/admission/' . $imageName;
        }

        if ($request->payment_type === 'installment') {
            // Dynamic validation
            $count = (int) $request->input('installment_count', 3);
            if (!in_array($count, [2, 3], true))
                $count = 3;

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
                    'installment_1' => "Installment total must equal full fee + applicable extras (expected: {$expected})."
                ]);
            }
        } else {
            // Full payment: sanitize installment fields so they can't trigger errors
            $request->merge([
                'installment_count' => null,
                'installment_1' => 0,
                'installment_2' => 0,
                'installment_3' => 0,
                'apply_additional_charges' => false,
            ]);
        }

        $lastRollNo = Admission::max('roll_no');
        $newRollNo = $lastRollNo ? $lastRollNo + 1 : 1;

        // Store admission
        Admission::create([
            'course_id' => $request->course_id,
            'batch_id' => $request->batch_id,
            'roll_no' => $newRollNo,
            'image' => $imagePath,
            'name' => $request->name,
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

            'payment_type' => $request->payment_type,
            'full_fee' => (int) $request->full_fee,
            'installment_1' => (int) $request->installment_1,
            'installment_2' => (int) $request->installment_2,
            'installment_3' => (int) $request->installment_3,
            'referral_type' => $request->referral_type,
        ]);

        return redirect()->route('admission.index')->with('store', 'Admission created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $admission = Admission::with(['course', 'batch'])->findOrFail($id);

        return view('admin.pages.dashboard.admission.show', compact('admission'));
    }


    /**
     * Show the form for editing the specified resource.
     */

    public function edit($id)
    {
        $admission = Admission::findOrFail($id);

        // infer installment_count from saved data (3 if a third installment exists)
        $preCount = ($admission->installment_3 ?? 0) > 0 ? 3 : 2;

        // infer whether extra charges were applied previously (1000 × count)
        $savedFee = (int) $admission->full_fee;
        $inst1 = (int) $admission->installment_1;
        $inst2 = (int) $admission->installment_2;
        $inst3 = (int) ($preCount === 3 ? $admission->installment_3 : 0);
        $sumInst = $inst1 + $inst2 + $inst3;
        $expectedIfExtra = $savedFee + (1000 * $preCount);
        $applyExtraDefault = ($sumInst === $expectedIfExtra);

        // load $courses, $batches as you already do
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


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $admission = Admission::findOrFail($id);

        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'batch_id' => 'required|exists:batches,id',
            'image' => 'nullable|image',
            'name' => 'required|string|max:255',
            'guardian_name' => 'nullable|string|max:255',
            'guardian_contact' => 'nullable|string|max:20',
            'cnic' => 'nullable|string|max:20',
            'dob' => 'nullable|date',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'joining_date' => 'nullable|date',
            'student_status' => 'required',
            'gender' => 'nullable|in:male,female',
            'qualification' => 'nullable|string|max:100',
            'last_institute' => 'nullable|string|max:255',
            'referral_source' => 'nullable|string|max:255',
            'referral_source_contact' => 'nullable|string|max:255',
            'referral_source_commission' => 'nullable|string|max:255',
            'address' => 'nullable|string',

            'payment_type' => 'required|in:full_fee,installment',
            'full_fee' => 'required|numeric|min:0',

            'installment_count' => 'nullable|in:2,3',
            'installment_1' => 'nullable|numeric|min:0',
            'installment_2' => 'nullable|numeric|min:0',
            'installment_3' => 'nullable|numeric|min:0',
            'apply_additional_charges' => 'nullable',

            'referral_type' => 'nullable|in:ads,referral,other',
            'calculated_total' => 'nullable|numeric|min:0',
        ]);

        // --- Payment logic ---
        if ($request->payment_type === 'installment') {
            $count = (int) $request->input('installment_count', 3);
            if (!in_array($count, [2, 3], true))
                $count = 3;

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
                    'installment_1' => "Installments must total to {$expected} (full fee + applicable extras)."
                ]);
            }
        } else {
            // ✅ Full payment: DO NOT error. Just clear/zero installment fields.
            $request->merge([
                'installment_count' => null,
                'installment_1' => 0,
                'installment_2' => 0,
                'installment_3' => 0,
                'apply_additional_charges' => false,
            ]);
        }

        // --- Image replace (optional) ---
        if ($request->hasFile('image')) {
            if ($admission->image && file_exists(public_path($admission->image))) {
                @unlink(public_path($admission->image));
            }
            $image = $request->file('image');
            $name = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('assets/admin/images/code/admission/'), $name);
            $admission->image = 'assets/admin/images/code/admission/' . $name;
        }

        // --- Save ---
        $admission->update([
            'course_id' => $request->course_id,
            'batch_id' => $request->batch_id,
            'name' => $request->name,
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

            'payment_type' => $request->payment_type,
            'full_fee' => (int) $request->full_fee,
            'installment_1' => (int) $request->installment_1,
            'installment_2' => (int) $request->installment_2,
            'installment_3' => (int) $request->installment_3, // safe: merged to 0 on full payment
            'referral_type' => $request->referral_type,
            // 'calculated_total' => (int) $request->input('calculated_total', $request->full_fee),
        ]);

        return redirect()->route('admission.index')->with('update', 'Admission updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
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
}
