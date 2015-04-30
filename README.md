CORS for Lumen
==========

[![Latest Stable Version](https://poser.pugx.org/dragonfire1119/cors-lumen/v/stable)](https://packagist.org/packages/dragonfire1119/cors-lumen)
[![License](https://poser.pugx.org/dragonfire1119/cors-lumen/license)](https://packagist.org/packages/dragonfire1119/cors-lumen)

[Cross-origin resource sharing](https://developer.mozilla.org/en-US/docs/Web/HTTP/Access_control_CORS) (CORS) Middleware for [Lumen micro-framework](http://lumen.laravel.com/).

### Install with [Composer](https://packagist.org/packages/dragonfire1119/cors-lumen) ###

Run `composer require "dragonfire1119/cors-lumen:dev-master"` to install cors-lumen.

## Usage ##

### Add CORS ServiceProvider ###

If you want to allow OPTIONS method then your going to need to enable the CorsServiceProvider in the `bootstrap/app.php` file.
```php
$app->register('Dragonfire1119\Cors\Providers\CorsServiceProvider');
```

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

## Contributing ##

If you have a change fork it & make a pull request. :)

## License ##

Released under the [MIT](LICENSE), see LICENSE.
