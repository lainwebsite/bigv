<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'rating',
        'vendor_id', 'category_id'
    ];

    public function vendor() {
        return $this->belongsTo(Vendor::class, 'vendor_id', 'id');
    }
    public function category() {
        return $this->belongsTo(ProductCategory::class, 'category_id', 'id');
    }
    public function variations() {
        return $this->hasMany(ProductVariation::class, 'product_id', 'id');
    }
    public function images() {
        return $this->hasMany(Productimage::class, 'product_id', 'id');
    }
}
