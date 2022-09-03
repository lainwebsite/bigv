<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptionCart extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id',
        'addon_option_id'
    ];
    public function cart() {
        return $this->belongsTo(Cart::class, 'cart_id', 'id');
    }
    public function addon_option() {
        return $this->belongsTo(AddonOption::class, 'addon_option_id', 'id');
    }
}
