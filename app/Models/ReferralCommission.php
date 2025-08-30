<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferralCommission extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function admission()
    {
        return $this->belongsTo(Admission::class, 'admission_id');
    }
    public function feeSubmission()
    {
        return $this->belongsTo(FeeSubmission::class, 'fee_submission_id');
    }
    public function histories()
    {
        return $this->hasMany(ReferralCommissionHistory::class);
    }
    public function lastPaidHistory()
    {
        return $this->hasOne(\App\Models\ReferralCommissionHistory::class, 'referral_commission_id')
            ->ofMany(['performed_at' => 'max'], function ($q) {
                $q->where('status', 'paid');
            });
    }
}
