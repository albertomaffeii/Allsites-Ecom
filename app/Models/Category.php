<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Brand;
use App\Models\Setting;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'meta_title',
        'meta_keyword',
        'meta_description',
        'status',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    public function relatedProducts()
    {
        $settings = Setting::first();
        return $this->hasMany(Product::class, 'category_id', 'id')->latest()->take($settings->number_images_trending);
    }

    public function brands()
    {
        return $this->hasMany(Brand::class, 'category_id', 'id')->where('status','0');
    }
}
