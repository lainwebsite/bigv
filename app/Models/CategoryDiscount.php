<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryDiscount extends Model
{
    use HasFactory;

    protected $fillable = [
        'discount_id',
        'product_category_id'
    ];
    public function discount() {
        return $this->belongsTo(Discount::class, 'discount_id', 'id');
    }
    public function product_category() {
        return $this->belongsTo(ProductCategory::class, 'product_category_id', 'id');
    }
}
