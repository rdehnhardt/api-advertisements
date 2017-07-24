<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param array $data
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseOk(array $data = [], $status = 200)
    {
        return response()->json($data, $status);
    }

    /**
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseError($status = 500)
    {
        return response()->json(['message' => 'fail'], $status);
    }

    /**
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseNotFound($status = 404)
    {
        return response()->json(['message' => 'not-found'], $status);
    }
}
