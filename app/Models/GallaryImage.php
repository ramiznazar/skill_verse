<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GallaryImage extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
        'images' => 'array',
    ];
    public function gallaryCategory()
    {
        return $this->belongsTo(GallaryCategory::class, 'gallary_category_id');
    }
}
