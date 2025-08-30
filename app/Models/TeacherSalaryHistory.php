<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherSalaryHistory extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
        'performed_at' => 'datetime',
    ];
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
    public function salary()
    {
        return $this->belongsTo(TeacherSalary::class, 'teacher_salary_id');
    }
    public function performedBy()
    {
        return $this->belongsTo(User::class, 'performed_by');
    }
}
