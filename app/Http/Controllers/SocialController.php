<?php namespace App\Http\Controllers;

use Auth, Input, Response, Socialize;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class SocialController extends Controller {

	protected $user;

	/**
     * Instantiate a new UserController instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

	public function redirectToProvider()
	{
	    return Socialize::with('facebook')->redirect();
	}

	public function handleProviderCallback()
	{
	    $facebookUser = Socialize::with('facebook')->user();

	    $user = User::where('facebook_id', '=', $facebookUser->id)->first();

	    if($user) {
	    	Auth::loginUsingId($user->id);
	    	$token = $user->createAuthToken();
	    } else {
	    	$user = User::create([
	    			'name' => $facebookUser->name,
	    			'facebook_id' => $facebookUser->id,
	    			'email' => $facebookUser->email
	    		]);

	    	Auth::loginUsingId($user->id);
	    	$token = $user->createAuthToken();
	    }

	    return [
	    	'user' => Auth::user(),
	    	'token' => $token
	    ];
	}

	public function getUserFromFacebookToken(Request $request)
	{
		// Retrieve the access token
		$accessToken = Input::json()->get('accessToken');

		// Retrieve the Facebook y=user
		$facebookUser = Socialize::with('facebook')->getUserByToken($accessToken);

		// Find or create the user in our database
		// and Authenticate the user
		$userAndToken = $this->user->handleFacebookUserAuthentication($facebookUser);

		return $userAndToken;
	}
}
