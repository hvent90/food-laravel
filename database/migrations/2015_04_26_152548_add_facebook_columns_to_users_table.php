<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFacebookColumnsToUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function(Blueprint $table)
		{
			$table->bigInteger('facebook_id')->after('name');
			$table->string('auth_token')->after('remember_token');
			$table->date('token_expiration_date')->after('auth_token');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function(Blueprint $table)
		{
			$table->dropColumn('facebook_id');
			$table->dropColumn('auth_token');
			$table->dropColumn('token_expiration_date');
		});
	}

}
