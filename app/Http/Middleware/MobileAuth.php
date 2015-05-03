<?php namespace App\Http\Middleware;

use App, Input, Log;
use Closure;
use App\User;
use App\Http\Requests;
use Illuminate\Http\Request;

class MobileAuth {

	protected $user;

	/**
     * Instantiate a new UserController instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		App::make('Pusher')->trigger('apiChannel', 'apiCall', ['custom' => 'test']);
		if ($request->isMethod('post')) {
			$authToken = Input::json()->get('auth_token');
		} else {
			$authToken = $request->get('auth_token');
		}
		Log::info('Logging auth token: '.$authToken);

		if (!$authToken) {
		    App::abort(401, 'No token');
		}

		if($this->user->isTokenValid($authToken)) {
			$user = User::where('auth_token', $authToken)->first();
			$request->merge(['user' => $user]);
			Log::info($user->email);
			Log::info('we got here...so it should work');
			return $next($request);
		}

		App::abort('MobileAuth middleware has a leak');
	}
}
