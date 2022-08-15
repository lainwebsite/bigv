<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'additional_info',
        'street',
        'building_name',
        'unit_level',
        'building_number',
        'unit_number',
        'postal_code',
        'user_id',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function billing_addresses() {
        return $this->hasMany(Transaction::class, 'billing_address_id', 'id');
    }
    public function shipping_addresses() {
        return $this->hasMany(Transaction::class, 'shipping_address_id', 'id');
    }
}
