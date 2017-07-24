<?php

namespace App\Http\Controllers\Pictures;

use App\Domain\Service\AdvertisementService;
use App\Domain\Service\PictureService;
use App\Http\Controllers\Controller;
use App\Http\Request\PictureRequest;
use App\Http\Transformer\PictureTransformer;
use Illuminate\Http\Request;

class PicturesController extends Controller
{
    /**
     * @var PictureService
     */
    private $pictures;
    /**
     * @var AdvertisementService
     */
    private $advertisements;

    /**
     * PicturesController constructor.
     * @param AdvertisementService $advertisements
     * @param PictureService $pictures
     */
    public function __construct(AdvertisementService $advertisements, PictureService $pictures)
    {
        $this->advertisements = $advertisements;
        $this->pictures = $pictures;
    }

    /**
     * Display a listing of the resource.
     *
     * @param string $uuid
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index($uuid, Request $request)
    {
        $advertisement = $this->advertisements->getByUser($request->user(), $uuid);

        if ($advertisement) {
            $pictures = $this->pictures->fetchAll($advertisement);

            return fractal($pictures, new PictureTransformer);
        }

        return $this->responseNotFound();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param string $uuid
     * @param PictureRequest $request
     * @return \Illuminate\Http\Response
     * @throws \Symfony\Component\HttpFoundation\File\Exception\FileException
     */
    public function store($uuid, PictureRequest $request)
    {
        $advertisement = $this->advertisements->getByUser($request->user(), $uuid);

        if ($advertisement) {
            $picture = $this->pictures->create($advertisement, $request->file('file'));

            return fractal($picture, new PictureTransformer);
        }

        return $this->responseNotFound();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param  string $uuid
     * @param  string $name
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy($uuid, $name, Request $request)
    {
        $advertisement = $this->advertisements->getByUser($request->user(), $uuid);

        if ($advertisement) {
            $picture = $this->pictures->delete($advertisement, $name);

            return fractal($picture, new PictureTransformer);
        }

        return $this->responseNotFound();
    }
}
