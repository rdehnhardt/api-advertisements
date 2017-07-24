<?php

namespace App\Http\Controllers\Auth;

use App\Domain\Service\UserService;
use App\Http\Controllers\Controller;
use App\Http\Request\User\RegisterRequest;
use App\Http\Transformer\UserTransformer;

class RegisterController extends Controller
{
    /**
     * @var CreateService
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
     * @param RegisterRequest $request
     * @return \Spatie\Fractal\Fractal
     * @throws \Illuminate\Database\Eloquent\MassAssignmentException
     */
    public function register(RegisterRequest $request)
    {
        $user = $this->service->create($request->all());

        return fractal($user, new UserTransformer);
    }
}
