<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'description', 'rating', 'featured_image', 'variation_name',
        'vendor_id', 'category_id'
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id', 'id');
    }

    public function variations()
    {
        return $this->hasMany(ProductVariation::class, 'product_id', 'id');
    }

    public function reviews()
    {
        return $this->hasMany(ProductReview::class, 'product_id', 'id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

    public function carts()
    {
        return $this->hasManyThrough(Cart::class, ProductVariation::class);
    }
    public function addons()
    {
        return $this->hasMany(Addon::class, 'product_id', 'id');
    }
}
