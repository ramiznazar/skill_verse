<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Batch;
use App\Models\Course;
use App\Models\Lead;
use App\Models\Admission;

class AdmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admissions = Admission::with(['course', 'batch'])->get();
        $totalStudents = $admissions->count();

        // Count active students
        $activeStudents = $admissions->where('student_status', 'active')->count();

        return view('admin.pages.dashboard.admission.index', compact('admissions', 'totalStudents', 'activeStudents'));
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
            'course_id'        => 'required|exists:courses,id',
            'batch_id'         => 'required|exists:batches,id',
            'image'            => 'nullable|image',
            'name'             => 'required|string|max:255',
            'guardian_name'    => 'nullable|string|max:255',
            'guardian_contact' => 'nullable|string|max:20',
            'cnic'             => 'nullable|string|max:20',
            'dob'              => 'nullable|date',
            'email'            => 'nullable|email|max:255',
            'phone'            => 'nullable|string|max:20',
            'joining_date'     => 'nullable|date',
            'student_status'           => 'required',
            'gender'           => 'nullable|in:male,female',
            'qualification'    => 'nullable|string|max:100',
            'last_institute'   => 'nullable|string|max:255',
            'referral_source'  => 'nullable|string|max:255',
            'referral_source_contact'  => 'nullable|string|max:255',
            'referral_source_commission'  => 'nullable|string|max:255',
            'address'          => 'nullable|string',

            'payment_type'     => 'required',
            'full_fee'         => 'required|numeric|min:0',

            'installment_1'    => 'nullable|numeric|min:0',
            'installment_2'    => 'nullable|numeric|min:0',
            'installment_3'    => 'nullable|numeric|min:0',
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

        // Validate installments total if installment mode
        if ($request->payment_type === 'installment') {
            // Get installment count (default to 3 if missing)
            $count = (int) $request->input('installment_count', 3);
            if (!in_array($count, [2, 3], true)) {
                $count = 3;
            }

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
            // Full payment: installments must be empty/zero
            $anyInst =
                ($request->filled('installment_1') && (int)$request->installment_1 > 0) ||
                ($request->filled('installment_2') && (int)$request->installment_2 > 0) ||
                ($request->filled('installment_3') && (int)$request->installment_3 > 0);

            if ($anyInst) {
                return back()->withInput()->withErrors([
                    'payment_type' => 'Installments should not be filled when Full Payment is selected.'
                ]);
            }
        }

        $lastRollNo = Admission::max('roll_no');
        $newRollNo = $lastRollNo ? $lastRollNo + 1 : 1;

        // Store admission
        Admission::create([
            'course_id'        => $request->course_id,
            'batch_id'         => $request->batch_id,
            'roll_no'          => $newRollNo,
            'image'            => $imagePath,
            'name'             => $request->name,
            'guardian_name'    => $request->guardian_name,
            'guardian_contact' => $request->guardian_contact,
            'cnic'             => $request->cnic,
            'dob'              => $request->dob,
            'email'            => $request->email,
            'phone'            => $request->phone,
            'joining_date'     => $request->joining_date,
            'student_status'   => $request->student_status,
            // 'fee_status'       => $request->fee_status,
            'gender'           => $request->gender,
            'qualification'    => $request->qualification,
            'last_institute'   => $request->last_institute,
            'referral_source'  => $request->referral_source,
            'referral_source_contact'  => $request->referral_source_contact,
            'referral_source_commission'  => $request->referral_source_commission,
            'address'          => $request->address,

            'payment_type'     => $request->payment_type,
            'full_fee'         => $request->full_fee,
            'installment_1'    => $request->installment_1,
            'installment_2'    => $request->installment_2,
            'installment_3'    => $request->installment_3,
            'referral_type' => $request->referral_type,

        ]);

        return redirect()->route('admission.index')->with('store', 'Admission created successfully.');
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
        $courses = Course::all();
        $batches = Batch::all();
        $admission = Admission::findOrFail($id);
        return view('admin.pages.dashboard.admission.update', compact('courses', 'batches', 'admission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $admission = Admission::findOrFail($id);

        $request->validate([
            'course_id'        => 'required|exists:courses,id',
            'batch_id'         => 'required|exists:batches,id',
            'image'            => 'nullable|image',
            'name'             => 'required|string|max:255',
            'guardian_name'    => 'nullable|string|max:255',
            'guardian_contact' => 'nullable|string|max:20',
            'cnic'             => 'nullable|string|max:20',
            'dob'              => 'nullable|date',
            'email'            => 'nullable|email|max:255',
            'phone'            => 'nullable|string|max:20',
            'joining_date'     => 'nullable|date',
            'student_status'   => 'required',
            'gender'           => 'nullable|in:male,female',
            'qualification'    => 'nullable|string|max:100',
            'last_institute'   => 'nullable|string|max:255',
            'referral_source'  => 'nullable|string|max:255',
            'referral_source_contact'  => 'nullable|string|max:255',
            'referral_source_commission'  => 'nullable|string|max:255',
            'address'          => 'nullable|string',

            'payment_type'     => 'required',
            'full_fee'         => 'required|numeric|min:0',

            'installment_1'    => 'nullable|numeric|min:0',
            'installment_2'    => 'nullable|numeric|min:0',
            'installment_3'    => 'nullable|numeric|min:0',
            'referral_type' => $request->referral_type,

        ]);

        if ($request->payment_type === 'installment') {
            $expected = $request->full_fee + 3000;
            $actual = ($request->installment_1 ?? 0) + ($request->installment_2 ?? 0) + ($request->installment_3 ?? 0);
            if ($actual !== $expected) {
                return back()->withInput()->withErrors(['installment_1' => 'Installments must total to ' . $expected]);
            }
        }

        if ($request->hasFile('image')) {
            if ($admission->image && file_exists(public_path($admission->image))) {
                unlink(public_path($admission->image));
            }

            $image = $request->file('image');
            $name = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('assets/admin/images/code/admission/'), $name);
            $admission->image = 'assets/admin/images/code/admission/' . $name;
        }

        $admission->update([
            'course_id'        => $request->course_id,
            'batch_id'         => $request->batch_id,
            'name'             => $request->name,
            'guardian_name'    => $request->guardian_name,
            'guardian_contact' => $request->guardian_contact,
            'cnic'             => $request->cnic,
            'dob'              => $request->dob,
            'email'            => $request->email,
            'phone'            => $request->phone,
            'joining_date'     => $request->joining_date,
            'student_status'   => $request->student_status,
            'gender'           => $request->gender,
            'qualification'    => $request->qualification,
            'last_institute'   => $request->last_institute,
            'referral_source'  => $request->referral_source,
            'referral_source_contact'  => $request->referral_source_contact,
            'referral_source_commission'  => $request->referral_source_commission,
            'address'          => $request->address,
            'payment_type'     => $request->payment_type,
            'full_fee'         => $request->full_fee,
            'installment_1'    => $request->installment_1,
            'installment_2'    => $request->installment_2,
            'installment_3'    => $request->installment_3,
        ]);

        return redirect()->route('admission.index')->with('update', 'Admission updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $admission = Admission::find($id);
        $imagePath = public_path($admission->image);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
        $admission->delete();
        return redirect()->route('admission.index')->with('delete', 'Admission deleted successfully!');
    }
}
