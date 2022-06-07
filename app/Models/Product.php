<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends RModel
{
    protected $table    = 'products';
    protected $fillable = [
        'name',
        'price',
        'category_id',
        'amount',
        'description'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function getPriceBrAttribute()
    {
        return number_format($this->price, 2, ',', '.');
    }
}
