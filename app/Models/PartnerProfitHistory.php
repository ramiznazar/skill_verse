<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnerProfitHistory extends Model
{
    use HasFactory;
    protected $fillable = ['partner_profit_id', 'partner_id', 'amount', 'status', 'paid_at'];
    



    public function profit()
    {
        return $this->belongsTo(PartnerProfit::class, 'partner_profit_id');
    }
    public function partner()
    {
        return $this->belongsTo(Partner::class, 'partner_id');
    }
}
