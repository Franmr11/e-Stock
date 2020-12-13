<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $guarded = [
        'create_at' => null,
        'update_at' => null
    ];

    protected $filliable = [
        'id_usuario',
        'nombre',
        'direccion',
        'telefono',
        'pais',
        'ciudad',
        'cod_postal',
        'cif',
        'logo'
    ];

    public function ComprobarEmpresa($empresa_id, $usuario_id){

        // Comprueba que la empresa pasada pertenece al usuario conectado
        $empresa = Empresa::Where('id', $empresa_id)
            ->where('id_usuario', $usuario_id)
            ->first();
            
        if ($empresa){
            return $empresa;
        }
        else{
            return false;
        }
    }
}