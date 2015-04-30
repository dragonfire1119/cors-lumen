<?php namespace Dragonfire1119\Cors\Middleware;

use Closure;
use Illuminate\Http\Response;
use Asm89\Stack\CorsService;

class CorsMiddleware
{

	protected $defaultSettings = array(
		'allowedHeaders'      	=> 'x-allowed-header,x-other-allowed-header',
		'allowedMethods'      	=> 'GET,HEAD,PUT,POST,DELETE',
		'allowedOrigins'      	=> '*',
		'exposedHeaders'      	=> false,
		'maxAge'             	=> false,
		'supportsCredentials' 	=> false,
	);

	public function __construct()
	{
		$this->allowedHeaders 	= env('CORS_HEADERS', $this->defaultSettings['allowedHeaders']);
		$this->allowedMethods 	= env('CORS_METHODS', $this->defaultSettings['allowedMethods']);
		$this->allowedOrigins 		= env('CORS_ORIGINS', $this->defaultSettings['allowedOrigins']);
		$this->exposedHeaders 	= env('CORS_EXPOSED_HEADERS', $this->defaultSettings['exposedHeaders']);
		$this->maxAge 		= env('CORS_MAX_AGE', $this->defaultSettings['maxAge']);
		$this->supportsCredentials 	= env('CORS_SUPPORTS_CREDENTIALS', $this->defaultSettings['supportsCredentials']);
	}

	/**
	 * Set the cors headers
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Illuminate\Http\Response  $response
	 * @return void
	 */
	protected function setCorsHeaders($request, $response) {

		$allowedHeaders 	= explode(",", $this->allowedHeaders);
		$allowedMethods 	= explode(",", $this->allowedMethods);
		$allowedOrigins 	= explode(",", $this->allowedOrigins);

		if($this->exposedHeaders != false) {
			$exposedHeaders 	= explode(",", $this->exposedHeaders);
		} else {
			$exposedHeaders 	= false;
		}

		if($this->maxAge != false) {
			$maxAge 	= explode(",", $this->maxAge);
		} else {
			$maxAge 	= false;
		}

		if($this->supportsCredentials != false) {
			$supportsCredentials 	= explode(",", $this->supportsCredentials);
		} else {
			$supportsCredentials 	= false;
		}

		$cors = new CorsService(array(
			'allowedHeaders'      	=> $allowedHeaders,
			'allowedMethods'      	=> $allowedMethods,
			'allowedOrigins'      	=> $allowedOrigins,
			'exposedHeaders'      	=> $exposedHeaders,
			'maxAge'              	=> $maxAge,
			'supportsCredentials' 	=> $supportsCredentials,
		));

		$cors->addActualRequestHeaders($response, $request);
		$cors->handlePreflightRequest($request);
		$cors->isActualRequestAllowed($request);
		$cors->isCorsRequest($request);
		$cors->isPreflightRequest($request);
	}

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next) {

		$response = $next($request);

		$this->setCorsHeaders($request, $response);

		return $response;
	}

}
