<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Course;
use App\Models\Batch;
use App\Models\FeeSubmission;


class Admission extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
        'full_fee' => 'float',
    ];



    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'admission_course_batch')
            ->withPivot([
                'batch_id',
                'course_fee',
                'payment_type',
                'installment_count',
                'installment_1',
                'installment_2',
                'installment_3',
                'apply_additional_charges',
            ])
            ->withTimestamps();
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class, 'batch_id');
    }

    public function batches()
    {
        return $this->belongsToMany(Batch::class, 'admission_course_batch', 'admission_id', 'batch_id')
            ->withPivot(['course_id', 'course_fee'])
            ->withTimestamps();
    }
    public function feeSubmissions()
    {
        return $this->hasMany(FeeSubmission::class);
    }
    public function recalcFeeStatus(): void
    {
        // Make sure we have the latest relations and submissions
        $this->loadMissing(['courses', 'feeSubmissions']);

        // Total paid from all submissions for this admission
        $totalPaid = (float) $this->feeSubmissions->sum('amount');

        // Expected total (multi-course -> sum of pivot course_fee; legacy -> full_fee)
        $expectedTotal = 0.0;

        if ($this->courses && $this->courses->count() > 0) {
            foreach ($this->courses as $course) {
                $expectedTotal += (float) ($course->pivot->course_fee ?? 0);
            }
        } else {
            $expectedTotal = (float) ($this->full_fee ?? 0);
        }

        // Guard against 0 to avoid always "complete"/"pending" edge cases
        $expectedTotal = max($expectedTotal, 1);

        // Decide status
        if ($totalPaid <= 0) {
            $this->fee_status = 'pending';
        } elseif ($totalPaid < $expectedTotal) {
            $this->fee_status = 'uncomplete';
        } else {
            $this->fee_status = 'complete';
        }

        $this->save();
    }
}
