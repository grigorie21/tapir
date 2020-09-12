<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;

    protected $table = 'ad';
    protected $fillable = [
        'title',
        'description',
        'cost',
    ];

    public function images()
    {
        return $this->belongsToMany(Image::class, 'ad_m2m_image', 'ad_id', 'image_id');
    }
}
