<?php

namespace App\Http\Controllers\Pictures;

use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
    /**
     * Display a original image
     *
     * @param string $file
     * @return \Illuminate\Http\Response
     */
    public function original($file)
    {
        $image = $this->getImage($file);

        return $image->response('jpg');
    }

    /**
     * Display a resize image
     *
     * @param int $width
     * @param string $file
     * @return \Illuminate\Http\Response
     */
    public function resize($width, $file)
    {
        $image = $this->getImage($file);
        $image->resize($width, null, function ($constraint) {
            $constraint->aspectRatio();
        });

        return $image->response('jpg');
    }

    /**
     * Display a resize image
     *
     * @param int $width
     * @param int $height
     * @param string $file
     * @return \Illuminate\Http\Response
     */
    public function crop($width, $height, $file)
    {
        $image = $this->getImage($file);
        $image->fit($width, $height, function ($constraint) {
            $constraint->upsize();
        });

        return $image->response('jpg');
    }

    /**
     * @param $file
     * @return \Intervention\Image\Image
     */
    private function getImage($file)
    {
        return Image::make(storage_path("app/pictures/$file"));
    }
}
