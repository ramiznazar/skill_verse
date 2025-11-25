<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestDay extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function bookings()
    {
        return $this->hasMany(TestBooking::class, 'test_day_id');
    }
}
