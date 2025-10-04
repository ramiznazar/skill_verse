<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $fillable = [
        'image',
        'name',
        'email',
        'phone',
        'qualification',
        'course_id',
        'experience',
        'pay_type',
        'percentage',
        'fixed_salary',
        'salary',
        'joining_date',
        'status',
        'notes',
    ];

    protected $casts = [
        'percentage' => 'integer',
        'fixed_salary' => 'integer',
        'joining_date' => 'date',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function batches()
    {
        return $this->hasMany(Batch::class);
    }

    public function salary()
    {
        return $this->hasMany(TeacherSalary::class);
    }
    public function balance()
    {
        return $this->hasMany(TeacherBalance::class);
    }
    public function attendance()
    {
        return $this->hasMany(TeacherAttendance::class);
    }
}
