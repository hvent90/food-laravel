<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTimeToBusiness extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('business', function(Blueprint $table)
		{
			$table->integer('time_cleaning')->after('pain')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('business', function(Blueprint $table)
		{
			$table->dropColumn('time_cleaning');
		});
	}

}
