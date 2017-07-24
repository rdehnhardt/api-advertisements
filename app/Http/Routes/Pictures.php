<?php

namespace App\Http\Routes;

use Illuminate\Contracts\Routing\Registrar as Router;

class Pictures
{
    /**
     * @param Router $router
     */
    public function map(Router $router)
    {
        $router->group(['middleware' => 'auth:api'], function (Router $router) {
            $router->resource('advertisements.pictures', 'PicturesController', ['only' => ['index', 'store', 'destroy']]);
        });

        $router->get('image/{file}', 'ImageController@original');
        $router->get('image/{width}/{file}', 'ImageController@resize');
        $router->get('image/{width}/{height}/{file}', 'ImageController@crop');
    }
}
