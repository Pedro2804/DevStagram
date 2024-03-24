<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImagenController extends Controller
{
    public function store(Request $request){
        $imagen = $request->file('file');
        $nombreImg = Str::uuid() . '.' . $imagen->extension();

        $manager = new ImageManager(new Driver());
        $imgServer = $manager->read($imagen);
        #$imgServer->scale(width: 1000, height: 1000);
        $imgServer->resizeDown(1000, 1000);

        $imgPath = public_path('uploads') . '/' . $nombreImg;

        $imgServer->toPng()->save($imgPath);

        return response()->json(["imagen" => $nombreImg]);
    }
}
