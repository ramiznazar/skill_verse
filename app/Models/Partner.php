<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;

    

   

    // Additional methods or relationships can be defined here
    // For example, if you want to define a relationship with Partner model

    protected $fillable = ['name', 'email', 'phone', 'investment', 'percentage'];

    public function profits()
    {
        return $this->hasMany(PartnerProfit::class);
    }

    public function balance()
    {
        return $this->hasOne(PartnerBalance::class);
    }
    public function profitHistory()
    {
        return $this->hasMany(PartnerProfitHistory::class);
    }
    public function profitCalculations()
    {
        return $this->hasMany(ProfitCalculation::class);
    }

}

    

   

    // Additional methods or relationships can be defined here
    // For example, if you want to define a relationship with Partner model





