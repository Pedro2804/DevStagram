<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;

class RegisterController extends Controller
{
    public function index () {
        return view('auth.register');
    }

    public function store (Request $request) {

        #Modificar el request (como ultima opcón) si se hace, solo hay que mandar a llamr al input en create
        $request->request->add(['username' => Str::slug( $request->username )]);

        #Validación
        $data_validate = $request->validate([
            'name' => 'required|max:30',
            'username' => 'required|unique:users|min:3|max:15',
            'email' => 'required|unique:users|email|max:40',
            'password' => 'required|confirmed|min:6'
        ]);

        #Insertar Dtaos
        User::create([
            'name' => $request->name, #$request->get('name')
            #'username' => Str::slug( $request->username ),
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make( $request->password )
        ]);

        #Autenticar
        // auth()->attempt([
        //     "email" => $request->email,
        //     "password" => $request->password
        // ]);

        #Otra forma de autenticar
        auth()->attempt($request->only('email', 'password'));

        #Redireccionar
        return redirect()->route('posts.index', $request->username);
    }
}