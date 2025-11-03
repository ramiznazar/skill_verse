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
}
