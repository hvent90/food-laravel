<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DateTime;

class Business extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'business';

	protected $dates = ['created_at'];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'happy',
		'blood',
		'pain',
		'consistency'
	];

	public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function getDates()
	{
	    return ['created_at'];
	}

    public function getCreatedAtAttribute($value)
    {
    	$date = new DateTime($value);
    	return $date->format('D, h:i A');
    }

}
