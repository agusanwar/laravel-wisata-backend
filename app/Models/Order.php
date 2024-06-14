<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_method',
        'cashier_id',
        'cashier_name',
        'total_item',
        'total_price',
        'payment_amount',
        'transaction_time',
    ];

    // relasi one to many order item
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'cashier_id');
    }

    // relasi user one many
    public function cashier()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
