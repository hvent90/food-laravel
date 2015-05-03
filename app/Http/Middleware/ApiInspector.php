<?php namespace App\Http\Middleware;

use App;
use Closure;

class ApiInspector {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		App::bind('Pusher', function($app) {
			$keys = $app['config']->get('services.pusher');
			return new \Pusher($keys['public'], $keys['secret'], $keys['app_id']);
		});

		App::make('Pusher')->trigger('apiChannel', 'apiCall', [
			// 'request' => json_encode($request),
			'method' => $request->method(),
			'root' => $request->root(),
			'url' => $request->url(),
			'path' => $request->path(),
			'ajax' => $request->ajax(),
			'ip' => $request->ip(),
			'input' => $request->all(),
			'input-json' => json_encode($request->json()),
			'is-json' => $request->isJson(),
			'wants-json' => $request->wantsJson(),
			'format' => $request->format(),
			'session' => json_encode($request->session()),
			'header' => $request->header()
		]);

		return $next($request);
	}

}
