<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    public function store(Request $request)
    {
        $imagen=$request->file('file'); //Obtener la imagen
        $nombreImagen=Str::uuid().".".$imagen->extension(); //Darle un nombre unico
        $imagenServidor=Image::make($imagen); //Imagen que se guarda en el servidor y permite usar intervention
        $imagenServidor->fit(1000,1000); //Usar intervention para hacer fit
        $imagenPath=public_path('uploads'). '/' . $nombreImagen; //Ruta donde se v a a guardar la imagen
        $imagenServidor->save($imagenPath); //Guardar la imagen
        return response()->json(['imagen'=>$nombreImagen]); //Esta es la respuesta que se le esta enviando del controllador
    }
}
