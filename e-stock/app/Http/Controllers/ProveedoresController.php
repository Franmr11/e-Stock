<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Empresa;
use App\Producto;
use App\Categoria;
use App\Proveedores;
use DB;
use App\Http\Controllers\Controller;


class ProveedoresController extends Controller{

    public function proveedorCreate(Request $request){

        $proveedor = new Proveedores;
        $proveedor = Proveedores::Create([
            'nombre' => $request->input('proveedor_nombre'),
            'id_empresa' => $request->input('proveedor_empresa'),
            'email' => $request->input('proveedor_email'),
            'telefono' => $request->input('proveedor_telefono'),
        ]);

        $proveedor->save();
        return redirect('/empresas/'.$request->input('proveedor_empresa').'/proveedores');
    }

    public function proveedorGet($empresa_id, $proveedor_id = null){

        if($usuario = Auth::user()){

            $empresa = new Empresa;
            $empresa = $empresa->ComprobarEmpresa($empresa_id, $usuario->id);

            if($empresa){
                if($proveedor_id){
                    $proveedor = Proveedores::find($proveedor_id);
                    $accion = 'Editar';

                    return view('ProveedoresForm', ['proveedor' => $proveedor, 'accion' => $accion]);
                }
                else{
                    $proveedor = new Proveedores();
                    $proveedor->id_empresa = $empresa_id;
                    $accion = 'Crear';

                    return view('ProveedoresForm', ['proveedor' => $proveedor, 'accion' => $accion]);
                }
            }
        }
    }

    public function proveedorEdit(Request $request){

        $proveedor_id = $request->input('proveedor_id');
        $proveedor = Proveedores::find($proveedor_id)->update([
            'nombre' => $request->input('proveedor_nombre'),
            'email' => $request->input('proveedor_email'),
            'telefono' => $request->input('proveedor_telefono'),
        ]);

        return redirect('/empresas/'.$request->input('proveedor_empresa').'/proveedores');
    }

    public function proveedorDelete($empresa_id, $proveedor_id){
        $proveedor = Proveedores::find($proveedor_id);

        $proveedor->delete();

        return redirect('/empresas/'.$empresa_id.'/proveedores');
    }

    public function proveedorIni($empresa_id){

        $usuario = Auth::user();
        $empresa = new Empresa();

        $empresa->ComprobarEmpresa($empresa_id, $usuario->id);
        $empresa = Empresa::find($empresa_id);
        
        $proveedores = Proveedores::where('id_empresa', $empresa->id)->get();

        if($proveedores){
            return view('ProveedoresIni', ['proveedores' => $proveedores, 'empresa' => $empresa]);
        }
        else{
            return view('ProveedoresIni', ['empresa' => $empresa]);
        }
    }
}