<?php namespace App;

use App;
use Auth;
use Carbon\Carbon;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * Mutates these columns to carbon objects.
	 *
	 * @var [type]
	 */
	protected $dates = ['token_expiration_date'];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'facebook_id',
		'email',
		'password',
		'auth_token',
		'token_expiration_date'
	];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	public function createAuthToken()
	{
		$token = str_random(100);

		$this->auth_token = $token;
		$this->token_expiration_date = Carbon::now()->addWeeks(2);
		$this->save();

		return $token;
	}

	public function handleFacebookUserAuthentication($facebookUser)
	{
		// Check to see if a record of the
		// Facebook user already exists in our database
		$user = User::where('facebook_id', '=', $facebookUser['id'])->first();

		// If it does...
		if($user) {
			// Authenticate the user
	    	Auth::loginUsingId($user->id);
	    	// and create a session token
	    	$token = $user->createAuthToken();
	    } else {
	    	// If the user does not exist,
	    	// create a new corresponding record in our database
	    	$user = User::create([
	    			'name' => $facebookUser['name'],
	    			'facebook_id' => $facebookUser['id'],
	    			'email' => $facebookUser['email']
	    		]);

	    	// and then Authenticate the user
	    	Auth::loginUsingId($user->id);
	    	// and create a session token
	    	$token = $user->createAuthToken();
	    }

	    return [
	    	'user' => Auth::user(),
	    	'token' => $token
	    ];
	}

	public function isTokenValid($authToken) {
		// Check to see if a user has
		// the given auth token
		$user = User::where('auth_token', $authToken)->first();

		if (!$user) {
			// If no user is found...
			App::abort(401, 'No users match the given token');
		} else {
			// If the token is found...
			$created = $user->token_expiration_date;
			$now = Carbon::now();

			if ($created->diff($now)->days < 1) {
				// If the token has expired...
				App::abort(401, 'Expired token');
			} else {
				// If the token is still valid...
				return true;
			}
		}
	}

	public function food()
    {
        return $this->belongsToMany('App\Food')->withTimestamps();
    }

}
