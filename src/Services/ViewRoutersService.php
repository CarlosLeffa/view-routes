<?php

namespace LeffaCarlos\ViewRoutes\Services;

use Illuminate\Support\Facades\Route;

class ViewRoutersService
{
    public function registerRoutes()
    {
        $hideInProductionConf = config('view-routes.hide_in_production');        
        if ($hideInProductionConf && app()->environment('production')) {
            return;
        }

        $hideInNonDebugConf = config('view-routes.hide_in_non_debug');        
        if ($hideInNonDebugConf && !app()->hasDebugModeEnabled()) {
            return;
        }        

        $routeConf = config('view-routes.route');
        if (empty($routeConf)) {
            return;
        }    
        
        $route = Route::get('/' . $routeConf, function () {
            return $this->show();
        });

        $routeNameConf = config('view-routes.name');     
        if (!empty($routeNameConf)) {
            $route->name($routeNameConf);
        }

        $middlewaresConf = config('view-routes.middlewares');
        if (!empty($middlewaresConf)) {
            $route->middleware(explode(",", $middlewaresConf));
        };
    }

    public function show()
    {
        $hideMethodsConf = strtoupper(config('view-routes.hide_methods'));
        $hideMethodsArray = empty($hideMethodsConf) ? [] : explode(",", strtoupper($hideMethodsConf));

        $showPrefixesConf = config('view-routes.show_prefixes');
        $showPrefixesArray = empty($showPrefixesConf) ? [] : explode(",", $showPrefixesConf);

        $hidePrefixesConf = config('view-routes.hide_prefixes');
        $hidePrefixesArray = empty($hidePrefixesConf) ? [] : explode(",", $hidePrefixesConf);
        
        $hideNamesPrefixesConf = config('view-routes.hide_names_prefixes');
        $hideNamesPrefixesArray = empty($hideNamesPrefixesConf) ? [] : explode(",", $hideNamesPrefixesConf);


        $routes = $this->getRoutes($hideMethodsArray);
        $routes = $this->fiterRoutes($routes, $showPrefixesArray, $hidePrefixesArray, $hideNamesPrefixesArray);
        
        usort($routes, fn($a, $b) => strcmp(strtoupper($a['uri']), strtoupper($b['uri'])));

        return view('view-routes::view-routes' , 
            [
                'title' => env('APP_NAME') . ' | ' . config('view-routes.route'),
                'header' =>  "HideMethods: $hideMethodsConf | ShowPrefixes: $showPrefixesConf | HidePrefixes: $hidePrefixesConf | HideNamesPrefixes: $hideNamesPrefixesConf | ",
                'routes' => $routes,
                'showPrefixes' => $showPrefixesConf
            ]);
    }

    private function getRoutes($hideMethodsArray)
    {
        $routesAll = Route::getRoutes();

        $routes = [];
        foreach ($routesAll as $value)
        {
            array_push($routes, [
                'uri' => $value->uri(),
                'methods' => array_filter($value->methods(), fn($m) => !in_array(strtoupper($m), $hideMethodsArray)),
                'name' => $value->getName(),
                'action' => $value->getActionName(),
                'middlewares' => $value->middleware(),
                'link' => in_array('GET', $value->methods()) ? $value->uri() : null
            ]);
        }
        return $routes;
    }

    private function fiterRoutes($routes, $showPrefixesArray, $hidePrefixesArray, $hideNamesPrefixesArray) {
        
        $routes = array_filter($routes, function($route) use ($showPrefixesArray, $hidePrefixesArray, $hideNamesPrefixesArray) {
            
            return (count($route['methods'])>0) &&
                ((count($showPrefixesArray)==0) || (count(array_filter($showPrefixesArray, fn($w) => str_starts_with($route['uri'], $w)))>0)) &&
                ((count($hidePrefixesArray)==0) || (count(array_filter($hidePrefixesArray, fn($w) => str_starts_with($route['uri'], $w)))==0)) &&
                ((count($hideNamesPrefixesArray)==0) || (count(array_filter($hideNamesPrefixesArray, fn($w) => str_starts_with($route['name'], $w)))==0));

        });
        return $routes;
    }

}