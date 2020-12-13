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



class EmpresasController extends Controller

{
    public function empresaCreate(Request $request){       

        $nombre = 'logo.png';
        if($request->file('logo')){
            $logo = $request->file('logo');
            
            $nombre =  time()."_".$logo->getClientOriginalName();
            
            \Storage::disk('logos')->put($nombre,  \File::get($logo));
        }

        $usuario = Auth::user();

        $empresa = new Empresa();
        $empresa= Empresa::Create([
            'id_usuario' => $usuario->id,

            'nombre' => $request->input('empresa_nombre'),

            'cif' => $request->input('empresa_CIF'),

            'telefono' => $request->input('empresa_telefono'),

            'direccion' => $request->input('empresa_direccion'),

            'pais' => $request->input('empresa_pais'),

            'ciudad' => $request->input('empresa_ciudad'),

            'cod_postal' => $request->input('cod_postal'),

            'logo' => $nombre

        ]);
        $empresa->save();

        return redirect('/home');
    }



    public function empresaGet($empresa_id = null)

    {
        if($usuario = Auth::user()){

            $empresa = new Empresa();



            if($empresa_id){

                $empresa = $empresa->ComprobarEmpresa($empresa_id, $usuario->id);

                

                if($empresa){



                    $empresa = Empresa::find($empresa_id);

                    $usuario = User::find($usuario->id);

                    

                    $accion = 'Editar';

                    return view('EmpresasForm', ['user' => $usuario, 'empresa' => $empresa, 'accion' => $accion]);

                }

            }

            else{

                $accion = 'Crear';

                return view('EmpresasForm', ['empresa' => $empresa, 'accion' => $accion]);

            }

        }

        else{

            return view('inicio');

        }

        return view('inicio');



    }



    public function empresaIni($empresa_id)

    {

        $path = public_path();

        $usuario = Auth::user();

        $empresa = Empresa::find($empresa_id);

        $empresa = $empresa->ComprobarEmpresa($empresa_id, $usuario->id);

        //$empresa = DB::select('SELECT * from empresas where id = ? AND id_usuario = ?', [$empresa_id, $usuario->id ]);

        if($empresa){

            $empresa->find($empresa_id);
            $productos = Producto::where('id_empresa', $empresa_id)->where('ignorar', 0)->where('stock', '<' , 5)->get();
            foreach($productos as $producto){
                if($producto->id_categoria){
                    $categoria = Categoria::find($producto->id_categoria);
                    $producto->categoria_nombre = $categoria->nombre;
                }else{
                    $producto->categoria_nombre = 'Sin categoria';
                }
                if($producto->id_proveedor){
                    $proveedor = Proveedores::find($producto->id_proveedor);
                    $producto->proveedor_nombre = $proveedor->nombre;
                }else{
                    $producto->proveedor_nombre = 'Sin proveedor';
                }
            }
            if($productos){
                foreach($productos as $producto){
                }
                return view('EmpresasIni', ['empresa' => $empresa,'productos' => $productos]);
            }
            return view('inicio');
        }



    }

    public function empresaEdit(Request $request){

        $empresa_id = $request->input('empresa_id');

        $empresa = Empresa::find($empresa_id);



        $logo = $request->file('logo');

        

        if($logo){

            $nombre =  time()."_".$logo->getClientOriginalName();

            \Storage::disk('logos')->put($nombre,  \File::get($logo));

        }

        else{

            $nombre = $empresa->logo;

        }

        $empresa->update([

            'nombre' => $request->input('empresa_nombre'),

            'cif' => $request->input('empresa_CIF'),

            'telefono' => $request->input('empresa_telefono'),

            'direccion' => $request->input('empresa_direccion'),

            'pais' => $request->input('empresa_pais'),

            'ciudad' => $request->input('empresa_ciudad'),

            'cod_postal' => $request->input('cod_postal'),

            'logo' => $nombre

        ]);
        return redirect('/empresas/'.$empresa_id.'/opciones');
    }

    public function empresaDelete($empresa_id){
        $empresa = Empresa::find($empresa_id);
        $empresa->delete();

        return redirect('/home');

    }
}

