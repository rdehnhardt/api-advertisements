<?php

namespace App\Http\Controllers\Auth;

use App\Domain\Service\UserService;
use App\Http\Controllers\Controller;
use App\Http\Request\User\MeRequest;
use App\Http\Transformer\UserTransformer;

class UserController extends Controller
{
    /**
     * @var UpdateService
     */
    private $service;

    /**
     * Create a new controller instance.
     * @param UserService $service
     */
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    /**
     * @param MeRequest $request
     * @return \Spatie\Fractal\Fractal
     * @throws \Illuminate\Database\Eloquent\MassAssignmentException
     */
    public function update(MeRequest $request)
    {
        $this->service->update($request->user(), $request->all());

        return fractal($request->user(), new UserTransformer);
    }
}
