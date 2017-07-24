<?php

namespace App\Http\Controllers\Advertisements;

use App\Domain\Service\AdvertisementService;
use App\Domain\Service\PictureService;
use App\Http\Controllers\Controller;
use App\Http\Request\AdvertisementRequest;
use App\Http\Transformer\AdvertisementTransformer;
use App\Http\Transformer\PictureTransformer;
use Illuminate\Http\Request;

class AdvertisementsController extends Controller
{
    /**
     * @var AdvertisementService
     */
    private $advertisements;

    /**
     * @var PictureService
     */
    private $pictures;

    /**
     * AdvertisementsController constructor.
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
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $advertisements = $this->advertisements->fetchAllByUser($request->user());

        return fractal($advertisements, new AdvertisementTransformer);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AdvertisementRequest $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Database\Eloquent\MassAssignmentException
     */
    public function store(AdvertisementRequest $request)
    {
        $advertisement = $this->advertisements->create($request->user(), $request->all());

        return fractal($advertisement, new AdvertisementTransformer);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $advertisement = $this->advertisements->getByUser($request->user(), $id);

        return fractal($advertisement, new AdvertisementTransformer);
    }

    /**
     * @param AdvertisementRequest $request
     * @param $id
     * @return \Spatie\Fractal\Fractal
     * @throws \Illuminate\Database\Eloquent\MassAssignmentException
     */
    public function update(AdvertisementRequest $request, $id)
    {
        $advertisement = $this->advertisements->update($request->user(), $id, $request->all());

        return fractal($advertisement, new AdvertisementTransformer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Request $request, $id)
    {
        $this->advertisements->delete($request->user(), $id);

        return $this->responseNotContent();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function publish(Request $request, $id)
    {
        $advertisement = $this->advertisements->togglePublished($request->user(), $id);

        return fractal($advertisement, new AdvertisementTransformer);
    }

    /**
     * @param Request $request
     * @return \Spatie\Fractal\Fractal
     */
    public function search(Request $request)
    {
        $advertisement = $this->advertisements->fetchPublished($request->get('q'));

        return fractal($advertisement, new AdvertisementTransformer($request->get('width'), $request->get('height')));
    }

    /**
     * @param string $uuid
     * @param Request $request
     * @return \Spatie\Fractal\Fractal
     */
    public function advertisement($uuid, Request $request)
    {
        $advertisement = $this->advertisements->get($uuid);

        return fractal($advertisement, new AdvertisementTransformer($request->get('width'), $request->get('height')));
    }

    /**
     * @param string $uuid
     * @param Request $request
     * @return \Spatie\Fractal\Fractal
     */
    public function images($uuid, Request $request)
    {
        $advertisement = $this->advertisements->get($uuid);
        $pictures = $this->pictures->fetchAll($advertisement);

        return fractal($pictures, new PictureTransformer);
    }
}
