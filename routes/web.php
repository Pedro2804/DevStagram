<?php

use App\Models\Comentario;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PerfilController;
use App\Livewire\LikePost;

#LOS GET'S SOLO SON PARA MOSTRAR UN TEMPLADE

#GET's sin variable
Route::get('/home', HomeController::class)->name('home')->middleware('auth'); #Pagina principal
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::get('/Editar-Perfil', [PerfilController::class, 'index'])->name('perfil.index')->middleware('auth');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create')->middleware('auth');
Route::get('/show', LikePost::class);

#GET´s con variable
Route::get('/{user:username}', [PostController::class, 'index'])->name('posts.index');
Route::get('/{user:username}/posts/{post}', [PostController::class, 'show'])->name('posts.show');

#LOS POST'S SON PARA CREAR CONSULTAS A LA BASE DE DATOS

#POST´s sin variable
Route::post('/register', [RegisterController::class, 'store']);
Route::post('/login', [LoginController::class, 'store']);
Route::post('/Editar-Perfil', [PerfilController::class, 'store'])->name('perfil.store');
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store')->middleware('auth'); #Crear una publicación
Route::post('/imagenes', [ImagenController::class, 'store'])->name('imagenes.store');

#POST´s con variable
Route::post('/{user:username}/posts/{post}', [ComentarioController::class, 'store'])->name('comentarios.store');
Route::post('/posts/{post}/likes', [LikeController::class, 'store'])->name('posts.likes.store'); #Guardar Like a las publicaciones
Route::post('/{user:username}/follow', [FollowerController::class, 'store'])->name('users.follow'); #Seguir a alguien

#DELELE
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy')->middleware('auth'); #Eliminar una publicación
Route::delete('/posts/{post}/likes', [LikeController::class, 'destroy'])->name('posts.likes.destroy'); #Eliminar Like a las publicaciones
Route::delete('/{user:username}/unfollow', [FollowerController::class, 'destroy'])->name('users.unfollow'); #Dejar de seguir