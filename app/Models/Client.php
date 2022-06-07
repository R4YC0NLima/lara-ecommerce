<?php

namespace App\Models;


class Client extends RModel
{
    protected $table    = 'clients';
    protected $fillable = [
        'name',
        'email',
        'cpf',
        'password'
    ];
}
