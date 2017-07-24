<?php

namespace App\Http\Transformer;

use App\Models\Picture;
use League\Fractal\TransformerAbstract;

class PictureTransformer extends TransformerAbstract
{
    /**
     * @param Picture $picture
     * @return array
     */
    public function transform(Picture $picture)
    {
        return [
            $this->getFile($picture->file)
        ];
    }

    /**
     * @param $file
     * @return string
     */
    private function getFile($file)
    {
        return url(sprintf('/image/%s', $file));
    }
}
