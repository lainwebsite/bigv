<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'quantity',
        'user_id',
        'product_variation_id',
        'transaction_id',
    ];

    public function product_variation() {
        return $this->belongsTo(ProductVariation::class, 'product_variation_id', 'id');
    }
    public function product_variation_trashed() {
        return $this->belongsTo(ProductVariation::class, 'product_variation_id', 'id')->withTrashed();
    }
    
    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
    public function transaction() {
        return $this->belongsTo(Transaction::class, 'transaction_id', 'id');
    }
    
    public function addon_options() {
        return $this->hasMany(OptionCart::class, 'cart_id', 'id');
    }
    
}
