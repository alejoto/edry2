<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table) {
			$table->increments('id');
			$table->string('email');
			$table->string('password');
			$table->text('permissions');
			$table->integer('activated');
			$table->string('activation_code');
			$table->timestamp('activated_at');
			$table->timestamp('last_login');
			$table->string('persist_code');
			$table->string('reset_password_code');
			$table->string('first_name');
			$table->string('last_name');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
