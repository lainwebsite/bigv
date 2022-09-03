<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountApplicable extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];
    public function discounts() {
        return $this->hasMany(Discount::class, 'applicable_id', 'id');
    }
}
