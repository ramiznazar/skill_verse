<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GallaryCategory extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function gallaryImage(){
        return $this->hasMany(GallaryImage::class,'category_id','id');
    }

}
