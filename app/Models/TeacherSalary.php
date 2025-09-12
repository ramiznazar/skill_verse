<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherSalary extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'month'                       => 'integer',
        'year'                        => 'integer',
        'total_students'              => 'integer',
        'total_fee_collected'         => 'integer',
        'percentage'                  => 'integer',
        'salary_amount'               => 'integer', // actual payable
        'computed_percentage_amount'  => 'integer',
        'computed_fixed_amount'       => 'integer',
        'pay_type'                    => 'string',  // NEW: snapshot mode for the month
    ];

    protected $attributes = [
        'pay_type' => 'percentage', // default for legacy rows
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
