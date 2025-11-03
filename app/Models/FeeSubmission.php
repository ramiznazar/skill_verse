<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeSubmission extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
        'amount' => 'float',
    ];
    public function admission()
    {
        return $this->belongsTo(Admission::class);
    }
    public function account()
    {
        return $this->belongsTo(Account::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
