<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PickupMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function transactions() {
        return $this->hasMany(Transaction::class, 'pickup_method_id', 'id');
    }
}
