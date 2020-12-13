<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use DB;
use App\Http\Controllers\Controller;

class UserController extends Controller{

    public function __construct(){
        $this->middleware('auth');
    }

    public function usuarioGet(){   
        $usuario = Auth::user();
        $usuario = User::find($usuario->id);
        return view('UsuariosForm', ['usuario' => $usuario]);
    }

    public function actualizarUsuario(Request $request){
        $usuario = Auth::user();
        $usuario = User::find($usuario->id);

        if($request->input('usuario_password') != $usuario->password){
            $pass = bcrypt($request->input('usuario_password'));
            $usuario = User::find($usuario->id);
            $usuario->password = Hash::make($request->input('usuario_password'));
        }
        $usuario->update([
            'usuario' => $request->input('usuario_usuario'),
            'nombre' => $request->input('usuario_nombre'),
            'apellidos' => $request->input('usuario_apellidos'),
            'telefono' => $request->input('usuario_telefono'),
            'email' => $request->input('usuario_email'),
        ]);
        $usuario->save();

        return back();

    }

    public function borrarUsuario(){
        $usuario = Auth::user();
        $usuario_find = User::find($usuario->id);
        $usuario_find->delete();

        return redirect('/');
    }

}