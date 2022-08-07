<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'discount',
        'product_id',
    ];

    public function product() {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    public function reviews() {
        return $this->hasMany(ProductReview::class, 'product_variation_id', 'id');
    }
}
