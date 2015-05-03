<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Third Party Services
	|--------------------------------------------------------------------------
	|
	| This file is for storing the credentials for third party services such
	| as Stripe, Mailgun, Mandrill, and others. This file provides a sane
	| default location for this type of information, allowing packages
	| to have a conventional place to find your various credentials.
	|
	*/

	'mailgun' => [
		'domain' => '',
		'secret' => '',
	],

	'mandrill' => [
		'secret' => '',
	],

	'ses' => [
		'key' => '',
		'secret' => '',
		'region' => 'us-east-1',
	],

	'stripe' => [
		'model'  => 'App\User',
		'key' => '',
		'secret' => '',
	],
	'facebook' => [
	    'client_id' => '529868813818134',
	    'client_secret' => 'ed8dab109859ba855cd65794b72806d5',
	    'redirect' => 'http://local.food.com/facebook/callback',
	],
	'pusher' => [
		'public' => getenv('PUSHER_PUBLIC'),
		'secret' => getenv('PUSHER_SECRET'),
		'app_id' => getenv('PUSHER_APP_ID')
	],

];
