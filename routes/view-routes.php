<?php

use Illuminate\Support\Facades\Route;

//if (env('APP_DEBUG'))
{
    if (env('TELESCOPE_ENABLED')) {
        Route::get('/' . env('TELESCOPE_PATH'), function() {});
    }
    $rotas = config('view-routes.rotas');
    Route::get($rotas, function() {
        $routesAll = Route::getRoutes();
        //dd($routesAll);

        $routes = [];
        foreach ($routesAll as $value)
        {
            if (!str_starts_with($value->uri(), env('TELESCOPE_PATH') . "/")) {
                array_push($routes, $value);
            }
        }
        //dd($routes);
        
        $prefix = '';//'api/';
        //return view('routes', compact('routes', 'prefix'));
        return view('view-routes::view-routes', compact('routes', 'prefix'));
    });

}

