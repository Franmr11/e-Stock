<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\User;

use App\Empresa;

use App\Categoria;

use DB;

use App\Http\Controllers\Controller;



class CategoriasController extends Controller

{

    public function categoriaCreate(Request $request){

        

        $categoria = new Categoria;

        $categoria = Categoria::Create([

            'nombre' => $request->input('categoria_nombre'),

            'id_empresa' => $request->input('categoria_empresa'),

        ]);

        $categoria->save();

        

        return redirect('/empresas/'.$request->input('categoria_empresa').'/categorias');

    }



    public function categoriaGet($empresa_id, $categoria_id = null){



        if($usuario = Auth::user()){

            

            $empresa = new Empresa;

            $empresa = $empresa->ComprobarEmpresa($empresa_id, $usuario->id);



            if($empresa){

                if($categoria_id){

                    $categoria = Categoria::find($categoria_id);

                    

                    $accion = 'Editar';

                    return view('CategoriasForm', ['categoria' => $categoria, 'accion' => $accion]);

                }

                else{

                    $categoria = new Categoria();

                    $categoria->id_empresa = $empresa_id;

                    

                    $accion = 'Crear';



                    return view('CategoriasForm', ['categoria' => $categoria, 'accion' => $accion]);

                }

            }

        }

    }



    public function categoriaEdit(Request $request){

        $categoria_id = $request->input('categoria_id');



        $categoria = categoria::find($categoria_id)->update([

            'nombre' => $request->input('categoria_nombre'),

        ]);



        return redirect('/empresas/'.$request->input('categoria_empresa').'/categorias');

    }

    



    public function categoriaDelete($empresa_id, $categoria_id){



        $categoria = Categoria::find($categoria_id);

        $categoria->delete();

        return redirect('/empresas/'.$empresa_id.'/categorias');



    }



    public function categoriaIni($empresa_id){

        $usuario = Auth::user();

        $empresa = new Empresa();



        $empresa->ComprobarEmpresa($empresa_id, $usuario->id);

        

        $empresa = Empresa::find($empresa_id);



        $categorias = Categoria::where('id_empresa', $empresa->id)->get();

        if($categorias){

            return view('CategoriasIni', ['categorias' => $categorias, 'empresa' => $empresa]);

        }

        else{

            return view('CategoriasIni', ['empresa' => $empresa]);

        }

    }

}

