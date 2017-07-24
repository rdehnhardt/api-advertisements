<?php

namespace App\Http\Routes;

use Illuminate\Contracts\Routing\Registrar as Router;

class Auth
{
    /**
     * @param Router $router
     */
    public function map(Router $router)
    {
        # Register
        $router->post('register', 'RegisterController@register');

        # Login
        $router->post('login', 'LoginController@login');

        # Send Reset Link
        $router->post('password/email', 'ForgotPasswordController@sendResetLinkEmail');

        # Reset Password
        $router->post('password/reset', 'ResetPasswordController@reset');

        # Update Data
        $router->put('me', 'UserController@update')->middleware('auth:api');
    }
}