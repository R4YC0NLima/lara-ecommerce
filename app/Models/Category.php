<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends RModel
{
    protected $table    = 'categories';
    protected $fillable = [
        'name',
        'description',
        'price',
        'category_id',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
