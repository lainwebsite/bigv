<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PickupAddress extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'additional_info',
        'block_number',
        'street',
        'unit_level',
        'unit_number',
        'building_name',
        'postal_code',
    ];

    public function transactions() {
        return $this->hasMany(Transaction::class, 'self_collection_address_id', 'id');
    }
}
