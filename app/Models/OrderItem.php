<?php

namespace App\Models;

use App\Models\Product;
use App\Models\ProductColor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'orderItems';

    protected $guarded = [];

    protected $fillable = [
        'order_id',
        'product_id',
        'product_color_id',
        'quantity',
        'quantity_unit',
        'price'
    ];

    /**
     * Get the Product that owns the OrderItem
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    /**
     * Get the productColor that owns the OrderItem
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function productColor(): BelongsTo
    {
        return $this->belongsTo(productColor::class, 'product_color_id', 'id');
    }

}
