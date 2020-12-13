<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\User;

use App\Empresa;

use App\Producto;

use App\Proveedores;

use App\Categoria;

use DB;

use App\Http\Controllers\Controller;



class ProductosController extends Controller

{

    

    public function productoCreate(Request $request){

        $producto = new Producto;

        $producto = Producto::Create([

            'nombre' => $request->input('producto_nombre'),

            'descripcion' => $request->input('producto_descripcion'),

            'stock' => $request->input('producto_stock'),

            'id_empresa' => $request->input('producto_empresa'),

            'id_proveedor' => $request->input('producto_proveedor'),

            'id_categoria' => $request->input('producto_categoria'),

        ]);

        $producto->save();

        

        return redirect('/empresas/'.$request->input('producto_empresa').'/productos');

    }



    public function productoEdit(Request $request){

        $producto_id = $request->input('producto_id');



        $producto = Producto::find($producto_id)->update([

            'nombre' => $request->input('producto_nombre'),

            'descripcion' => $request->input('producto_descripcion'),

            'stock' => $request->input('producto_stock'),

            'id_proveedor' => $request->input('producto_proveedor'),

            'id_categoria' => $request->input('producto_categoria'),

        ]);



        return redirect('/empresas/'.$request->input('producto_empresa').'/productos');

    }



    public function productoDelete($empresa_id, $producto_id){



        $producto = Producto::find($producto_id);

        $producto->delete();

        return redirect('/empresas/'.$empresa_id.'/productos');



    }



    public function productoGet($empresa_id, $producto_id = null)

    {

        if($usuario = Auth::user()){

            

            $empresa = new Empresa;

            $empresa = $empresa->ComprobarEmpresa($empresa_id, $usuario->id);



            //$proveedor = new Proveedores;

            if($empresa){

                if($producto_id){

                    $producto = Producto::find($producto_id);



                    $proveedores = DB::select('SELECT * FROM proveedores WHERE id_empresa = ? OR id_empresa IS NULL', [$empresa_id]);

                    $categorias = DB::select('SELECT * FROM categorias WHERE id_empresa = ? OR id_empresa IS NULL', [$empresa_id]);

                    

                    $accion = 'Editar';

                    return view('ProductosForm', ['producto' => $producto ,'proveedores' => $proveedores, 'categorias' => $categorias, 'accion' => $accion]);

                }

                else{

                    $producto = new Producto();

                    $producto->id_empresa = $empresa_id;

                    $producto->stock = 0;

                    

                    // Al quitar first peta.

                    // $proveedores = Proveedores::Where('id_empresa', $empresa_id)

                    //                 ->OrWhere('id_empresa', 0)

                    //                 ->first()

                    //                 ;

                    

                    $proveedores = DB::select('SELECT * FROM proveedores WHERE id_empresa = ? OR id_empresa IS NULL', [$empresa_id]);

                    $categorias = DB::select('SELECT * FROM categorias WHERE id_empresa = ? OR id_empresa IS NULL', [$empresa_id]);

                    

                    $accion = 'Crear';

                    return view('ProductosForm', ['producto' => $producto ,'proveedores' => $proveedores, 'categorias' => $categorias, 'accion' => $accion]);

                }

            }

        }

        else{

            return view('inicio');

        }

    }

        

    public function productoIni($empresa_id){

        $usuario = Auth::user();
        $empresa = new Empresa;
        $empresa = $empresa->ComprobarEmpresa($empresa_id, $usuario->id);
        if($empresa){

            $empresa->find($empresa_id);
            $productos = Producto::where('id_empresa', $empresa_id)->get();
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
                return view('ProductosIni', ['empresa' => $empresa,'productos' => $productos]);
            }
            
            else{
                
                $productos = array();
                
                return view('ProductosIni', ['empresa' => $empresa]);
                
            }
            return view('inicio');
        }

    }



    public function productoIgnorar($empresa_id, $producto_id, $ignorar){

        if($ignorar == "true"){
            $ignorar = 1;
        }else{
            $ignorar = 0;
        }
        $producto = new Producto();

        $producto = Producto::find($producto_id)->update(array('ignorar' => $ignorar));

        return redirect('/empresas/'.$empresa_id.'/productos/edit/'.$producto_id);

    }



    public function listaCompraCreate($empresa_id, $producto_id, $cantidad = NULL){

        if($cantidad){

            DB::table('lista_compra')

              ->where('id', $producto_id)

              ->update(['cantidad' => $cantidad]);

        }

        else{

            $comprobar =  DB::table('lista_compra')

                            ->where('id_producto', $producto_id)

                            ->first();

            

            if($comprobar){

                $cantidad = $comprobar->cantidad + 1;

                DB::table('lista_compra')

                            ->where('id_producto', $producto_id)

                            ->update(['cantidad' => $cantidad]);

            }else{

                $producto = Producto::find($producto_id);

                DB::table('lista_compra')->insert([

                    'id_empresa' => $producto->id_empresa,

                    'id_proveedor' => $producto->id_proveedor,

                    'id_producto' => $producto_id

                    ]);

            }

        }

        return redirect('/empresas/'.$empresa_id.'/listaCompra');

    }



    public function listaCompraIni($empresa_id){
        $usuario = Auth::user();

        $empresa = new Empresa;

        $empresa = $empresa->ComprobarEmpresa($empresa_id, $usuario->id);
        if($empresa){

            $consulta= DB::select('SELECT *
                        FROM lista_compra
                        WHERE id_empresa = ?', [$empresa_id]);
            foreach($consulta as $lista_compra){
                $producto = Producto::find($lista_compra->id_producto);
                $lista_compra->nombre_prod = $producto->nombre;
                if($producto->id_proveedor){
                        $proveedor = Proveedores::find($producto->id_proveedor);
                        $lista_compra->proveedor_nombre = $proveedor->nombre;
                        $lista_compra->proveedor_telefono = $proveedor->telefono;
                        $lista_compra->proveedor_email = $proveedor->email;
                    }else{
                        $lista_compra->proveedor_nombre = "Sin proveedor";
                        $lista_compra->proveedor_telefono = "-";
                        $lista_compra->proveedor_email = "-";
                    }
                $empresa->find($empresa_id);
            }
            if($consulta){
                return view('ListaCompraIni', ['empresa' => $empresa,'lista_compra' => $consulta]);
            }
            else{
                $productos = array();
                return view('ListaCompraIni', ['empresa' => $empresa]);
            }
            return view('inicio');
        }
    }

    public function productoListaDelete($empresa_id, $producto_lista_id){
        $empresa = new Empresa;
        $empresa->find($empresa_id);
        $producto_lista = DB::table('lista_compra')->where('id', $producto_lista_id)->delete();
        return redirect('/empresas/'.$empresa_id.'/listaCompra');
    }

}

