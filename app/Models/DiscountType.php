<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];
    public function discounts() {
        return $this->hasMany(Discount::class, 'type_id', 'id');
    }
}
