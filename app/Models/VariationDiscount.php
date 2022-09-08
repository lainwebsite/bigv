<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariationDiscount extends Model
{
    use HasFactory;

    protected $fillable = [
        'discount_id',
        'product_variation_id'
    ];
    public function discount() {
        return $this->belongsTo(Discount::class, 'discount_id', 'id');
    }
    public function product_variation() {
        return $this->belongsTo(ProductVariation::class, 'product_variation_id', 'id');
    }
}
