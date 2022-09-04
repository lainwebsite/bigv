<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'description', 'color_code', 'photo_url'
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
    public function category_discounts()
    {
        return $this->hasMany(CategoryDiscount::class, 'product_category_id', 'id');
    }
}
