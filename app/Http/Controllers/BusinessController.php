<?php namespace App\Http\Controllers;

use App, Input, Log, Response;
use App\Business;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Carbon\Carbon;
use Illuminate\Http\Request;

class BusinessController extends Controller {

	public function submit(Request $request)
	{
		if (Input::json()->get('happy')) {
			$business =  Business::create(['happy' => 1]);
		} else {
			$business =  Business::create([
				'blood' => Input::json()->get('blood'),
				'pain' => Input::json()->get('pain'),
				'consistency' => Input::json()->get('consistency')
			]);
		}

		$request->get('user')->business()->save($business);

		return 'good job bro';
	}

	public function index(Request $request)
	{
		$oneWeekAgo = Carbon::now()->subWeek();

		return $request->get('user')->business()->where('created_at', '>', $oneWeekAgo)->orderBy('id', 'asc')->get();
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
