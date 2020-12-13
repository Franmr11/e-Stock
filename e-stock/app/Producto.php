<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $guarded = [
        'create_at' => null,
        'update_at' => null
    ];

    protected $filliable = [
        'nombre',
        'descripcion',
        'stock',
        'id_empresa',
        'id_proveedor',
        'id_categoria',
        'ignorar'
    ];
}