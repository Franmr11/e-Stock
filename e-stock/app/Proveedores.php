<?php



namespace App;



use Illuminate\Database\Eloquent\Model;



class Proveedores extends Model

{

    protected $guarded = [
        'create_at' => null,
        'update_at' => null
    ];



    protected $filliable = [
        'nombre',
        'id_empresa',
        'email',
        'telefono'
    ];

}