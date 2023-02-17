<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'description',
        'photo',
        'rating',
        'location_id'
    ];
    
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function location()
    {
        return $this->belongsTo(VendorLocation::class, 'location_id', 'id');
    }
    public function products()
    {
        return $this->hasMany(Product::class, 'vendor_id', 'id');
    }
    public function variations()
    {
        return $this->hasManyThrough(ProductVariation::class, Product::class);
    }
    public function carts() {
        return $this->hasManyDeep(Cart::class, [Product::class, ProductVariation::class]);
    }
    public function vendor_discounts()
    {
        return $this->hasMany(VendorDiscount::class, 'vendor_id', 'id');
    }
}
