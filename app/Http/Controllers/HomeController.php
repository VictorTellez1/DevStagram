<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function __invoke()
    {
        //Obtener el id de a quienes seguimos
        $ids=(auth()->user()->followings->pluck('id')->toArray()); //pluck solo se trae los campos que le especifiques
        $posts=Post::whereIn('user_id',$ids)->latest()->paginate(20);
        return view('home',compact('posts'));
    }
    
    
}
