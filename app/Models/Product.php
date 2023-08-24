<?php

namespace App\Models;

use App\Models\ProductImage;
use App\Models\ProductColor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

        /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'gross_weight' => 'decimal:4',
        'net_weight' => 'decimal:4',
        'original_price' => 'decimal:2',
        'selling_price' => 'decimal:2',
        'quantity' => 'decimal:4',
        'height' => 'decimal:4',
        'width_or_diameter' => 'decimal:4',
        'length' => 'decimal:4',
    ];


    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'brand',
        'small_description',
        'description',
        'original_price',
        'selling_price',
        'sku',
        'quantity',
        'quantity_unit',
        'trending',
        'featured',
        'status',
        'gross_weight',
        'net_weight',
        'packaging_type',
        'height',
        'width_or_diameter',
        'length',
        'meta_title',
        'meta_keyword',
        'meta_description',
    ];

    public function category()
    {
        return $this->belongsTo(category::class, 'category_id', 'id');
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

    public function productColors()
    {
        return $this->hasMany(ProductColor::class, 'product_id', 'id');
    }


}
