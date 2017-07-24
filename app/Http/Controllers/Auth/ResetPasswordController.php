<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get the response for a successful password reset.
     *
     * @param  string $response
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendResetResponse($response)
    {
        return $this->responseOk([
            'data' => ['message' => trans($response)]
        ]);
    }
}
