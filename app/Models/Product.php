<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'name',
        'category_id',
        'price',
        'image',
        'stock',
        'status',
        'criteria',
        'desc',
        'is_favorite'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
