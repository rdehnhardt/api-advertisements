<?php

namespace App\Http\Transformer;

use App\Models\Advertisement;
use Illuminate\Support\Collection;
use League\Fractal\TransformerAbstract;

class AdvertisementTransformer extends TransformerAbstract
{
    /**
     * @var int
     */
    private $width;

    /**
     * @var int
     */
    private $height;

    /**
     * AdvertisementTransformer constructor.
     * @param int $width
     * @param int $height
     */
    public function __construct($width = 300, $height = 150)
    {
        $this->width = $width;
        $this->height = $height;
    }

    /**
     * @param Advertisement $advertisement
     * @return array
     */
    public function transform(Advertisement $advertisement)
    {
        return [
            'uuid' => $advertisement->uuid,
            'tags' => $advertisement->tags,
            'title' => $advertisement->title,
            'cover' => $this->getCover($advertisement->pictures),
            'price' => $advertisement->price,
            'published' => $advertisement->published_at ? (string)$advertisement->published_at : null,
            'description' => $advertisement->description,
        ];
    }

    /**
     * @param Collection $pictures
     * @return string
     */
    private function getCover(Collection $pictures)
    {
        $file = 'no-picture.jpg';

        if ($pictures->count()) {
            $file = $pictures->first()->file;
        }

        return url(sprintf('/image/%s/%s/%s', $this->width, $this->height, $file));
    }
}
