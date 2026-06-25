<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title', 'slug', 'category', 'price_inr', 'secure_zip_path', 'demo_video_url'
    ];
}