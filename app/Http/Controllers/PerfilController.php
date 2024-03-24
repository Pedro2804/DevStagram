<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class PerfilController extends Controller
{
    public function index(){
        return view('perfil.index');
    }
    
    public function store(Request $request){
        #Modificar el request (como ultima opcón) si se hace, solo hay que mandar a llamr al input en create
        $request->request->add(['username' => Str::slug( $request->username )]);
        
        $request->validate([
            'username' => ['required', 'unique:users,username,'.auth()->user()->id, 'min:3', 'max:15',
                           'not_in:Editar-Perfil,editar-perfil'],
            'email' => ['required', 'unique:users,email,'.auth()->user()->id, 'email', 'max:40'],
            #'password_new' => 'min:0',
            'password' => 'required'
        ]);

        if ($request->imagen) {
            $imagen = $request->file('imagen');
            $nombreImg = Str::uuid() . '.' . $imagen->extension();

            $manager = new ImageManager(new Driver());
            $imgServer = $manager->read($imagen);
            $imgServer->resizeDown(1000, 1000);

            $imgPath = public_path('perfiles') . '/' . $nombreImg;

            $imgServer->toPng()->save($imgPath);
        }

        #Guardar cambios
        $usuario = User::find(auth()->user()->id);

        if (!auth()->attempt(['email' => $usuario->email, 'password' => $request->password])) {
            return back()->with('Mensaje', 'Contraseña Incorrecta');
        }

        $usuario->username = $request->username;
        $usuario->email = $request->email;
        $usuario->imagen = $nombreImg ?? auth()->user()->imagen ?? null;

        if($request->password_new){
            $usuario->password =  $request->password_new;
        }

        $usuario->save();

        return redirect()->route('posts.index', $usuario->username);
    }
}
