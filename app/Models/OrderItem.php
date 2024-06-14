<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'total_price',
    ];

    // relasi one to many order item
    public function order()
    {
        return $this->hasMany(Order::class, 'order_id');
    }

    // relasi user one many
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
