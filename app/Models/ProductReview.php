<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'rating',
        'description',
        'variation_name',
        'product_id',
        'user_id',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function product_variation() {
        return $this->belongsTo(ProductVariation::class, 'product_variation_id', 'id');
    }
    public function images() {
        return $this->hasMany(ReviewImage::class, 'review_id', 'id');
    }
}
