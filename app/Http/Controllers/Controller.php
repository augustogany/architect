<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

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
}
