<?php



namespace App\Http\Controllers;

use App\User;
use App\Empresa;

use Auth;

use DB;

use Illuminate\Http\Request;



class HomeController extends Controller{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $usuario = Auth::user();

        $empresas = Empresa::where('id_usuario', $usuario->id)->get();

        return view('home', ['empresas'=>$empresas]);
    }
}

