<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Addon extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'required',
        'product_id'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function addons_options()
    {
        return $this->hasMany(AddonOption::class, 'addon_id', 'id');
    }
    public function options()
    {
        return $this->hasMany(AddonOption::class, 'addon_id', 'id');
    }
}
