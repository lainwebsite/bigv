<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductVariation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'price',
        'discount',
        'discount_start_date',
        'discount_end_date',
        'product_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    public function carts()
    {
        return $this->hasMany(Cart::class, 'product_variation_id', 'id');
    }
    public function reviews()
    {
        return $this->hasMany(ProductReview::class, 'product_variation_id', 'id');
    }
    public function variation_discounts()
    {
        return $this->hasMany(VariationDiscount::class, 'product_variation_id', 'id');
    }
}
