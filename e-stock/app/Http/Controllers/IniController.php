<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;

class IniController extends Controller{

    public function ini(){

        return view('inicio');
    }

    public function Datos($id){
        $user = User::findOrFail($id);
        return view('user.profile', ['user' => $user]);
    }

    public function mandarEmail(Request $request){
        $email = "franmr1104@gmail.com";
        $email_asunto = "Contacto desde e-Stock";
        if(isset($request->nombre) || isset($request->apellidos) || isset($request->email) || isset($request->telefono) || isset($request->mensaje)) {

            $email_mensaje = "Detalles del formulario de contacto:\n\n";
            $email_mensaje .= "Nombre: ".$request->nombre."\n";
            $email_mensaje .= "Apellido: ".$request->apellidos."\n";
            $email_mensaje .= "E-mail: ".$request->email."\n";
            $email_mensaje .= "Teléfono: ".$request->telefono."\n";
            $email_mensaje .= "mensaje: ".$request->mensaje."\n\n";
            
            $cabecera = 'From: '.$request->email."\r\n".
            'Reply-To: '.$request->email."\r\n" .
            'X-Mailer: PHP/' . phpversion();
            @mail($email, $email_asunto, $email_mensaje, $cabecera);

            return view('inicio');
        }else{
            
            return view('inicio');
        }
    }
}

