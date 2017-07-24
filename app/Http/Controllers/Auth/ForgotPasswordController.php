<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get the response for a successful password reset link.
     *
     * @param  string $response
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendResetLinkResponse($response)
    {
        return $this->responseOk([
            'data' => ['message' => trans($response)]
        ]);
    }
}
