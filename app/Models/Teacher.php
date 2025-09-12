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
        'skill',
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
        'percentage'    => 'integer',
        'fixed_salary'  => 'integer',
        'joining_date'  => 'date',
    ];

    public function batch()
    {
        return $this->hasOne(Batch::class);
    }
    public function salary()
    {
        return $this->hasMany(TeacherSalary::class);
    }
    public function balance()
    {
        return $this->hasMany(TeacherBalance::class);
    }
}
