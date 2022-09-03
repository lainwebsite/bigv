<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorDiscount extends Model
{
    use HasFactory;

    protected $fillable = [
        'discount_id',
        'vendor_id'
    ];
    public function discount() {
        return $this->belongsTo(Discount::class, 'discount_id', 'id');
    }
    public function vendor() {
        return $this->belongsTo(Vendor::class, 'vendor_id', 'id');
    }
}
