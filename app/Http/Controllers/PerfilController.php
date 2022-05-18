<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller

{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('perfil.index');
    }
    public function store(Request $request)
    {
        $request->request->add(['username'=>Str::slug($request->username)]);
        $this->validate($request,[
            'username'=>['required','unique:users,username,'.auth()->user()->id,'min:3','max:20','not_in:twitter,editar-perfil'], //username, '.auth.... Revisa si ese usuario que quiere cambiar el nombre es el mismo que el nombre que se coloca en el formulario
            'email'=>['required','unique:users,email,'.auth()->user()->id,'email']
        ]);
        if($request->imagen){
            $imagen=$request->file('imagen'); //Obtener la imagen
            $nombreImagen=Str::uuid().".".$imagen->extension(); //Darle un nombre unico
            $imagenServidor=Image::make($imagen); //Imagen que se guarda en el servidor y permite usar intervention
            $imagenServidor->fit(1000,1000); //Usar intervention para hacer fit
            $imagenPath=public_path('perfiles'). '/' . $nombreImagen; //Ruta donde se v a a guardar la imagen
            $imagenServidor->save($imagenPath); //Guardar la imagen
        }
        
        if($request->password)
        {
            if(!Hash::check($request->password,Auth()->user()->password)){ //Auth tiene un metodo llamado attempt que intenta autenticar al usuario, el request remember guarda un token en la base de datos que corresponde a una cookie que guarda la informacion
                return back()->with('mensaje','Contraseña Incorrecta');
            }
            if(!$request->nuevo)
            {
                return back()->with('mensaje2','Necesitas escribir la nueva contraseña');
            }
            if(Str::length($request->nuevo)<6)
            {
                return back()->with('mensaje3','La contraseña debe tener minimo 6 caracteres');
            }


        }
        $usuario=User::find(auth()->user()->id);
        $usuario->username=$request->username;
        $usuario->imagen=$nombreImagen ?? auth()->user()->imagen  ?? null; //Sino hay imagen va a la base de datos a recibiar si ya hay imagen previa si no hay pone el null
        $usuario->email=$request->email;
        $usuario->password=Hash::make($request->nuevo);
        $usuario->save();
        //Redireccionar





        return redirect()->route('post.index',$usuario->username); //Pasamos la ultima version del username por si lo modifico el usuario


    }

}
