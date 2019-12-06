<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImagesController extends Controller
{
    public function destroy(Image $image)
    {
        unlink(public_path('uploads/' .$image->apartments_id .'/' .$image->path));
        $image->delete();
        return response('Success', 200);
    }
}
