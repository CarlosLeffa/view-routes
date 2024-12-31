<?php

return [

    /**
     * Defines whether the route will be hidden in a production environment
     */
    'hide_in_production' => env('VIEW_ROUTES_HIDE_IN_PRODUCTION', true),

    /**
     * Defines whether the route will be hidden in a non-debug environment
     */
    'hide_in_non_debug' => env('VIEW_ROUTES_HIDE_IN_NON_DEBUG', true),

    /**
     * Specifies the path of the route
     */
    'route' => env('VIEW_ROUTES_ROUTE', 'view-routes'),

    /**
     * Specifies the name of the route
     */
    'name' => env('VIEW_ROUTES_ROUTE_NAME', 'view.routes'),

    /**
     * Comma separated middlewares can be applied to protect the route
     * Ex: web,auth:api
     */
    'middlewares' => env('VIEW_ROUTES_MIDDLEWARES', ''),

    /**
     * Allows you to hide routes that have the following comma separated methods
     */
    'hide_methods' => env('VIEW_ROUTES_HIDE_METHODS', 'HEAD,OPTIONS,TRACE'),

    /**
     * You can specify some initial paths to list the routes
     * Ex: api\,login
     */
    'show_prefixes' => env('VIEW_ROUTES_SHOW_PREFIXES', ''),

    /**
     * Some initial prefixes can be defined to hide the routes. By the route path.
     * Ex: oauth,reset-password,view-routes
     */
    'hide_prefixes' => env('VIEW_ROUTES_HIDE_PREFIXES', env('VIEW_ROUTES_ROUTE', 'view-routes')),

    /**
     * Some initial prefixes can be defined to hide the routes. By the route name.
     * Ex: passport.view.routes
     */
    'hide_names_prefixes' => env('VIEW_ROUTES_HIDE_NAMES_PREFIXES', env('VIEW_ROUTES_ROUTE_NAME', 'view.routes')),

];
