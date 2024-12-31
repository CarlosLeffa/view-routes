Laravel Routes WEB view
====

This package allows you to view Laravel routes on a web page.
Allows a range of configurations such as path, name and access route middleware, display or not in production or debug environments, as well as the possibility of filters by route path and name.


![view-routes](https://github.com/CarlosLeffa/view-routes/blob/main/images/web_page.png)

# Installation

```bash
composer require leffacarlos/view-routes
```

# Configuration

By default a route will be created for `/view-routes`.
If you wish, you can publish the configuration file but all keys can be written to your .env file as explained below:

#### VIEW_ROUTES_HIDE_IN_PRODUCTION=`true`

Defines whether the route will be hidden in a production environment

----

#### VIEW_ROUTES_HIDE_IN_NON_DEBUG=`true`

Defines whether the route will be hidden in a non-debug environment

----

#### VIEW_ROUTES_ROUTE=`view-routes`

Specifies the path of the route

----

#### VIEW_ROUTES_ROUTE_NAME=`view.routes`

Specifies the name of the route

----

#### VIEW_ROUTES_MIDDLEWARES=

Comma separated middlewares can be applied to protect the route
Ex: `web,auth:api`

----

#### VIEW_ROUTES_HIDE_METHODS=`HEAD,OPTIONS,TRACE`

Allows you to hide routes that have the following comma separated methods

----

#### VIEW_ROUTES_SHOW_PREFIXES=

You can specify some initial paths to list the routes
Ex: `api\,login`

----

#### VIEW_ROUTES_HIDE_PREFIXES=`view-routes`

Some initial prefixes can be defined to hide the routes. By the route path.
Ex: `oauth,reset-password,view-routes`

----

#### VIEW_ROUTES_HIDE_NAMES_PREFIXES=`view.routes`

Some initial prefixes can be defined to hide the routes. By the route name.
Ex: `passport.view.routes`

----


## License

The VIEW-ROUTES is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
