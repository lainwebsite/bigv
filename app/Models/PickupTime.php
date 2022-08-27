<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PickupTime extends Model
{
    use HasFactory;
    protected $fillable = [
        'time'
    ];

    public function transactions() {
        return $this->hasMany(Transaction::class, 'pickup_time_id', 'id');
    }
}
