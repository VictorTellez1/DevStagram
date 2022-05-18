<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'email'=>'required|email',
            'password'=>'required',
        ]);

        if(!auth()->attempt($request->only('email','password'),$request->remember)){ //Auth tiene un metodo llamado attempt que intenta autenticar al usuario, el request remember guarda un token en la base de datos que corresponde a una cookie que guarda la informacion
            return back()->with('mensaje','Credenciales Incorrectas');
        }
        return redirect()->route('post.index',auth()->user()->username);
    }
}
