<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function courseCategory(){
        return $this->belongsTo(CourseCategory::class);
    }
    public function courseDiscussion(){
        return $this->hasMany(EventDiscussion::class);
    }
    public function eventParticipant(){
        return $this->hasMany(EventParticipant::class);
    }
}
