<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'code',
        'description',
        'amount',
        'max_quota', 'min_order', 'min_tier_points',
        'duration_start',
        'duration_end',
        'type_id', 'applicable_id'
    ];
    public function type()
    {
        return $this->belongsTo(DiscountType::class, 'type_id', 'id');
    }
    public function applicable()
    {
        return $this->belongsTo(DiscountApplicable::class, 'applicable_id', 'id');
    }
    public function transaction_discounts()
    {
        return $this->hasMany(TransactionDiscount::class, 'discount_id', 'id');
    }
    public function variation_discounts()
    {
        return $this->hasMany(VariationDiscount::class, 'discount_id', 'id');
    }
    public function category_discounts()
    {
        return $this->hasMany(CategoryDiscount::class, 'discount_id', 'id');
    }
    public function vendor_discounts()
    {
        return $this->hasMany(VendorDiscount::class, 'discount_id', 'id');
    }
}
