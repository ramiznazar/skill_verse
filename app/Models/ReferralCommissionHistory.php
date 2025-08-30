<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferralCommissionHistory extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
        'performed_at' => 'datetime',
    ];
    public function commission()
    {
        return $this->belongsTo(ReferralCommission::class);
    }
    public function performedBy()
    {
        return $this->belongsTo(User::class, 'performed_by');
    }
    public function admission()
    {
        return $this->belongsTo(Admission::class);
    }
    
}
