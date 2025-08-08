<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfitCalculation extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'profit_calculations';
    protected $fillable = [
        'month',
        'year',
        'total_income',
        'total_expense',
        'net_profit',
    ];
    
  
    

    



    public function profits()
    {
        return $this->hasMany(PartnerProfit::class);
    }
    


}
