<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PickupAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'additional_info',
        'street',
        'building_name',
        'unit_level',
        'building_number',
        'unit_number',
        'postal_code',
    ];

    public function transactions() {
        return $this->hasMany(Transaction::class, 'self_collection_address_id', 'id');
    }
}
