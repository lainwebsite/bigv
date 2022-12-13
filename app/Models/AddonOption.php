<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AddonOption extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'price',
        'addon_id'
    ];

    public function addon() {
        return $this->belongsTo(Addon::class, 'addon_id', 'id');
    }
    public function carts() {
        return $this->hasMany(Cart::class, 'addon_option_id', 'id');
    }
}
