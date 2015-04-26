<?php namespace Dragonfire1119\Cors\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Response;

class CorsServiceProvider extends ServiceProvider
{

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		/** @var \Illuminate\Http\Request $request */
		$request = $this->app->make('request');

		if($request->isMethod('OPTIONS'))
		{
			$this->app->options($request->path(), function()
			{
				return response('OK', 200);
			});
		}
	}

}
