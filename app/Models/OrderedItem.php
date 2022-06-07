<?php

namespace App\Models;


class OrderedItem extends RModel
{
    protected $table    = 'ordered_items';
    protected $fillable = [
        'amount',
        'price',
        'dt_item',
        'id_product',
        'id_order'
    ];
}
