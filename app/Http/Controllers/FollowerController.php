<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function store(User $user,Request $request) //User es el usuario que se esta visitando
    {
        $user->followers()->attach(auth()->user()->id); //En este caso se usa attach porque no estamos usando modelos como en likes que es de tipo usuario y post que son modelos, es relacion con la misma tabla por eso es mejor usar atach
        return back();
    }
    public function destroy(User $user)
    {
        $user->followers()->detach(auth()->user()->id);
        return back();
    }
}
