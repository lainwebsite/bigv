<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_price',
        'shipping_fee',
        'product_discount_total',
        'shipping_discount_total',
        'delivery_date',
        'is_reviewed',
        'billing_address_id',
        'shipping_address_id',
        'payment_method_id',
        'pickup_method_id',
        'pickup_time_id',
        'user_id',
        'status_id',
        'self_collection_address_id',
        'payment_request_id'
    ];

    public function carts()
    {
        return $this->hasMany(Cart::class, 'transaction_id', 'id');
    }
    public function transaction_discounts()
    {
        return $this->hasMany(TransactionDiscount::class, 'transaction_id', 'id');
    }
    public function discounts()
    {
        return $this->hasManyThrough(Discount::class, TransactionDiscount::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function billing_address()
    {
        return $this->belongsTo(UserAddress::class, 'billing_address_id', 'id');
    }
    public function shipping_address()
    {
        return $this->belongsTo(UserAddress::class, 'shipping_address_id', 'id');
    }
    public function billing_address_trashed()
    {
        return $this->belongsTo(UserAddress::class, 'billing_address_id', 'id')->withTrashed();
    }
    public function shipping_address_trashed()
    {
        return $this->belongsTo(UserAddress::class, 'shipping_address_id', 'id')->withTrashed();
    }
    public function payment_method()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id', 'id');
    }
    public function pickup_method()
    {
        return $this->belongsTo(PickupMethod::class, 'pickup_method_id', 'id');
    }
    public function pickup_address()
    {
        return $this->belongsTo(PickupAddress::class, 'self_collection_address_id', 'id');
    }
    public function pickup_address_trashed()
    {
        return $this->belongsTo(PickupAddress::class, 'self_collection_address_id', 'id')->withTrashed();
    }
    public function pickup_time()
    {
        return $this->belongsTo(PickupTime::class, 'pickup_time_id', 'id');
    }
    public function status()
    {
        return $this->belongsTo(TransactionStatus::class, 'status_id', 'id');
    }
}
