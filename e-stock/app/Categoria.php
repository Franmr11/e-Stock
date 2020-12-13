<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $guarded = [
        'create_at' => null,
        'update_at' => null
    ];

    protected $filliable = [
        'nombre',
        'id_empresa'
    ];
}