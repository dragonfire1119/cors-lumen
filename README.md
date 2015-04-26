CORS for Lumen
==========

[![Latest Stable Version](https://poser.pugx.org/dragonfire1119/cors-lumen/v/stable)](https://packagist.org/packages/dragonfire1119/cors-lumen)
[![License](https://poser.pugx.org/dragonfire1119/cors-lumen/license)](https://packagist.org/packages/dragonfire1119/cors-lumen)

[Cross-origin resource sharing](https://developer.mozilla.org/en-US/docs/Web/HTTP/Access_control_CORS) (CORS) Middleware for [Lumen micro-framework](http://lumen.laravel.com/).

## Installation ##

After you install lumen as per [lumen docs](http://lumen.laravel.com/docs/installation#install-lumen), install cors-lumen from `src` folder.

### Install with [Composer](https://packagist.org/packages/dragonfire1119/cors-lumen) ###

Run `composer require "dragonfire1119/cors-lumen:dev-master"` to install cors-lumen.

## Usage ##

### Global CORS ###

If you want CORS enabled for every HTTP request to your application, simply list the middleware class `dragonfire1119\Cors\Middleware\CorsMiddleware` in the $app->middleware() call of your `bootstrap/app.php` file.

### CORS for Routes ###

If you would like to enable CORS to specific routes, you should first assign the `cors` middleware a short-hand key in your `bootstrap/app.php` file.

```php
$app->routeMiddleware([
	'cors' => 'Dragonfire1119\Cors\Middleware\CorsMiddleware',
]);
```

Then, you use the key in the route options array.
```php
$app->get('/api/test', ['middleware' => 'cors', function() {
    //
}]);
```

More info. - http://lumen.laravel.com/docs/middleware#registering-middleware

## License ##

Released under the [MIT](LICENSE), see LICENSE.
