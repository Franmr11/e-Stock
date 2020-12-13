<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    //return view('welcome');
    return view('inicio');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/ini/{id}', 'IniController@Datos')->name('ini');
Route::post('/mail', 'IniController@mandarEmail')->name('enviar_mail');

/* Empresas Routes */
Route::get('/empresas/new', 'EmpresasController@empresaGet')->name('empresas_form');

Route::post('/empresas/new', 'EmpresasController@empresaCreate')->name('empresas_add');
Route::get('/empresas/{id}/inicio', ['id' => 'empresa_id','uses' => 'EmpresasController@empresaIni'])->name('empresas_ini');

Route::get('/empresas/{id_empresa}/opciones', ['id_empresa' => 'empresa_id','uses' => 'EmpresasController@empresaGet'])->name('empresas_edit_form');
Route::post('/empresas/opciones', 'EmpresasController@empresaEdit')->name('empresas_edit');
 
Route::get('/empresas/{id_empresa}/delete', ['id_empresa' => 'empresa_id','uses' => 'EmpresasController@empresaDelete'])->name('empresas_delete');



/* Productos Routes */
Route::get('/empresas/{id}/productos', ['id' => 'empresa_id','uses' => 'ProductosController@productoIni'])->name('productos_ini');

Route::get('/empresas/{id}/productos/new', 'ProductosController@productoGet')->name('productos_add_form');
Route::post('/productos/add', 'ProductosController@productoCreate')->name('productos_add');

Route::get('/empresas/{id_empresa}/productos/edit/{id_producto}', ['id_producto' => 'producto_id','uses' => 'ProductosController@productoGet'])->name('productos_edit_form');
Route::get('/empresas/{id_empresa}/productos/edit/{id_producto}/{ignorar}', ['id_empresa' => 'empresa_id','id_producto' => 'producto_id', 'ignorar' => 'ignorar','uses' => 'ProductosController@productoIgnorar'])->name('productos_edit_form');
Route::post('/productos/edit', 'ProductosController@productoEdit')->name('productos_edit');
Route::get('/empresas/{id_empresa}/productos/delete/{id_producto}', ['id_empresa' => 'empresa_id','id_producto' => 'producto_id','uses' => 'ProductosController@productoDelete'])->name('productos_delete');

/* Compra routes */
Route::get('/empresas/{id}/listaCompra', ['id' => 'empresa_id','uses' => 'ProductosController@listaCompraIni'])->name('listaCompra_ini');
Route::get('/empresas/{id_empresa}/listaCompra/delete/{id_producto_lista}', ['id_empresa' => 'empresa_id','id_producto_lista' => 'producto_lista_id','uses' => 'ProductosController@productoListaDelete'])->name('productos_lista_delete');
Route::get('/empresas/{id_empresa}/listaCompra/new&compra_id={producto_lista_id}&cantidad={cantidad}', ['id_empresa' => 'empresa_id', 'producto_lista_id' => 'producto_lista_id', 'cantidad' => 'cantidad', 'uses' => 'ProductosController@listaCompraCreate'])->name('productos_lista_add');
Route::get('/empresas/{id_empresa}/listaCompra/new&prod={id_producto}', ['id_empresa' => 'empresa_id', 'id_producto' => 'producto_id', 'uses' => 'ProductosController@listaCompraCreate'])->name('productos_lista_add');

/* Categorias Routes */
Route::get('/empresas/{id}/categorias', ['id' => 'empresa_id','uses' => 'CategoriasController@categoriaIni'])->name('categorias_ini');

Route::get('/empresas/{id}/categorias/new', 'CategoriasController@categoriaGet')->name('categorias_add_form');
Route::post('/categorias/add', 'CategoriasController@categoriaCreate')->name('categorias_add');

Route::get('/empresas/{id_empresa}/categorias/edit/{id_categoria}', ['id_categoria' => 'categoria_id','uses' => 'CategoriasController@categoriaGet'])->name('categorias_edit_form');
Route::post('/categorias/edit', 'CategoriasController@categoriaEdit')->name('categorias_edit');
Route::get('/empresas/{id_empresa}/categorias/delete/{id_categorias}', ['id_empresa' => 'empresa_id','id_categoria' => 'categoria_id','uses' => 'CategoriasController@categoriaDelete'])->name('categorias_delete');

/* Proveedores Routes */
Route::get('/empresas/{id}/proveedores', ['id' => 'empresa_id','uses' => 'ProveedoresController@proveedorIni'])->name('proveedor_ini');

Route::get('/empresas/{id}/proveedores/new', 'ProveedoresController@proveedorGet')->name('proveedores_add_form');
Route::post('/proveedores/add', 'ProveedoresController@proveedorCreate')->name('proveedores_add');

Route::get('/empresas/{id_empresa}/proveedores/edit/{id_proveedor}', ['id_proveedor' => 'proveedor_id','uses' => 'ProveedoresController@proveedorGet'])->name('proveedores_edit_form');
Route::post('/proveedores/edit', 'ProveedoresController@proveedorEdit')->name('proveedores_edit');
Route::get('/empresas/{id_empresa}/proveedores/delete/{id_proveedores}', ['id_empresa' => 'empresa_id','id_proveedor' => 'proveedor_id','uses' => 'ProveedoresController@proveedorDelete'])->name('proveedores_delete');

/* User Routes */
Route::get('usuario/edit',  ['usuario' => 'id_usuario', 'uses' => 'UserController@usuarioGet']);
Route::post('usuarios/update',  'UserController@actualizarUsuario');
Route::get('usuarios/delete',  'UserController@borrarUsuario');
