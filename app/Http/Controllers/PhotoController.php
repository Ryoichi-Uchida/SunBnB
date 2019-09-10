<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Photo;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class PhotoController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function destroy($id)
    {
        $photo = Photo::find($id);

        if($photo->delete()){
            $photo->delete_photoDirectory();
            
            return Response::json([
                'message' => "delete success!"
            ]);
        }else{
            return Response::json([
                'message' => "delete failed.."
            ]);
        }
    }
}
