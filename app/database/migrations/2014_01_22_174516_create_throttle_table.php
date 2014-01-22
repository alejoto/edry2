<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateThrottleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('throttle', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->string('ip_address');
			$table->integer('attempts');
			$table->integer('suspended');
			$table->integer('banned');
			$table->timestamp('last_attempt_at');
			$table->timestamp('suspended_at');
			$table->timestamp('banned_at');
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
		Schema::drop('throttle');
	}

}
