<?php namespace App\Http\Controllers;

use App, Input, Log, Response;
use App\Food;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class FoodController extends Controller {

	public function index()
	{
		return Food::orderBy('name', 'asc')->get();
	}

	public function add(Request $request)
	{
		$food = ['name' => Input::json()->get('foodName')];

		$food = Food::firstOrCreate($food);

		$request->get('user')->food()->attach($food);

		return Food::orderBy('name', 'asc')->get();
	}

	public function paginationTest()
	{
		return Food::paginate(5);
	}
}
