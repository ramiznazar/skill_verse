<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $guarded = [];

     public function batch(){
        return $this->hasOne(Batch::class);
    }
    public function salary(){
        return $this->hasMany(TeacherSalary::class);
    }
    public function balance()
    {
        return $this->hasMany(TeacherBalance::class);
    }
}
