<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function agregar_archivo($file, $folder){
        try {
            Storage::makeDirectory("/public/$folder/".date('F').date('Y'));
            $base_name = Str::random(20).'.'.$file->getClientOriginalExtension();

            $path = $file->storeAs(
                "$folder/".date('F').date('Y'), $base_name
            );

            return $path;
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function agregar_imagenes($file, $dir){
        Storage::makeDirectory($dir.'/'.date('F').date('Y'));
        $base_name = Str::random(20);

        // imagen normal
        $filename = $base_name.'.'.$file->getClientOriginalExtension();
        $image_resize = Image::make($file->getRealPath())->orientate();
        $image_resize->resize(1000, null, function ($constraint) {
            $constraint->aspectRatio();
            // $constraint->upsize();
        });
        $path =  $dir.'/'.date('F').date('Y').'/'.$filename;
        $image_resize->save(public_path('storage/'.$path));
        $imagen = $path;

        // imagen mediana
        $filename_medium = $base_name.'_medium.'.$file->getClientOriginalExtension();
        $image_resize = Image::make($file->getRealPath())->orientate();
        $image_resize->resize(512, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $path_medium =  $dir.'/'.date('F').date('Y').'/'.$filename_medium;
        $image_resize->save(public_path('storage/'.$path_medium));

        // imagen pequeña
        $filename_small = $base_name.'_small.'.$file->getClientOriginalExtension();
        $image_resize = Image::make($file->getRealPath())->orientate();
        $image_resize->fit(256, 256, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $path_small = $dir.'/'.date('F').date('Y').'/'.$filename_small;
        $image_resize->save(public_path('storage/'.$path_small));

        return $imagen;
    }
}
