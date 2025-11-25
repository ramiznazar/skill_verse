<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestBooking extends Model
{
    use HasFactory;

    //     protected $fillable = [
    //     'name','email','phone','course_id','test_date','status',
    //     'attendance_status','result_status','discount_code','score','attempted_at'
    // ];
    protected $guarded = [];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function testDay()
    {
        return $this->belongsTo(TestDay::class, 'test_day_id');
    }
    public function batch()
    {
        return $this->belongsTo(Batch::class, 'batch_id');
    }
}
