<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseCategory extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function course(){
        return $this->hasMany(Course::class);
    }
    public function event(){
        return $this->hasOne(Event::class);
    }
}
