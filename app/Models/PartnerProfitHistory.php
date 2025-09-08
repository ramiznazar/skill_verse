<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnerProfitHistory extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
        'performed_at' => 'datetime',
    ];


    public function profit()
    {
        return $this->belongsTo(PartnerProfit::class, 'partner_profit_id');
    }
    public function partner()
    {
        return $this->belongsTo(Partner::class, 'partner_id');
    }
    public function performedBy()
    {
        return $this->belongsTo(User::class, 'performed_by');
    }
}
