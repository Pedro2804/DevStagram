<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function index(User $user){

        $posts = Post::where('user_id', $user->id)->latest()->paginate(20);
        
        return view('layouts.dashboard', [
            'user' => $user,
            'posts' => $posts
        ]);
    }

    public function create(){
        return view('posts.create');
    }

    public function store(Request $request){
        $request->validate([
            "titulo" => 'required|max:255',
            "descripcion" => 'required',
            "imagen" => 'required'
        ]);

        Post::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]);

        #otra forma de guardar
        /*$post = new Post;
        $post->titulo = $request->titulo;
        $post->descripcion = $request->descripcion;
        $post->imagen = $request->imagen;
        $post->user_id = auth()->user()->id;
        $post->save();*/

        #Guardar ya con su relación definida
        /*$request->user()->posts()->create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]);*/

        return redirect()->route('posts.index', auth()->user()->username);
    }

    public function show(User $user, Post $post){
        return view('posts.show',[
            'user' => $user,
            'post' => $post
        ]);
    }

    public function destroy(Post $post){
        Gate::authorize('delete', $post);
        $post->delete();

        $imgPath = public_path('uploads/' . $post->imagen);

        if (File::exists($imgPath)) {
            unlink($imgPath);
        }
        return redirect()->route('posts.index', auth()->user()->username);
    }
}
