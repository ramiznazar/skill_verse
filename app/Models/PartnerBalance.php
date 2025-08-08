<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnerBalance extends Model
{
    use HasFactory;
     protected $fillable = ['partner_id', 'total_balance'];

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }
}
