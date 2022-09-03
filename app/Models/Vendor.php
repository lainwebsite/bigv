<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'description',
        'location',
        'photo',
        'rating',
        'location_id'
    ];

    public function products() {
        return $this->hasMany(Product::class, 'vendor_id', 'id');
    }
    public function vendor_discounts()
    {
        return $this->hasMany(VendorDiscount::class, 'vendor_id', 'id');
    }
}
