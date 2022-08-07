<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'amount',
        'duration_start',
        'duration_end',
        'type_id'
    ];
    public function type() {
        return $this->belongsTo(DiscountType::class, 'type_id', 'id');
    }
    public function transaction_discounts() {
        return $this->hasMany(TransactionDiscount::class, 'discount_id', 'id');
    }
}
