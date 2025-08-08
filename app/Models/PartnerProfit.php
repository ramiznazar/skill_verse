<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnerProfit extends Model
{
    use HasFactory;
    protected $guarded = [];
    

    public function partner() {
    return $this->belongsTo(Partner::class);
}

public function history() {
    return $this->hasMany(PartnerProfitHistory::class);
}
    public function calculation() {
        return $this->belongsTo(ProfitCalculation::class, 'profit_calculation_id');
    }
}
