<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDiscount extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id', 'discount_id'
    ];
    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id', 'id');
    }
    public function discount()
    {
        return $this->belongsTo(Discount::class, 'discount_id', 'id');
    }
}
