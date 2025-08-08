<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function courseCategory(){
        return $this->belongsTo(CourseCategory::class);
    }
    public function outline(){
        return $this->hasMany(CourseOutline::class);
    }
    public function courseFee(){
        return $this->hasOne(CourseFee::class);
    }
     public function batch(){
        return $this->hasOne(Batch::class);
    }
    public function lead(){
        return $this->hasMany(Lead::class);
    }
}
