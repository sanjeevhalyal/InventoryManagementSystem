<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user', function(Blueprint $table)
		{
			$table->integer('ID', true);
			$table->string('NAME', 100)->nullable();
			$table->string('EMAIL', 100);
			$table->string('CONTACT', 15)->nullable();
			$table->string('TYPE', 45)->nullable();
			$table->string('STATUS', 45)->nullable();
			$table->string('SOCIETY', 60)->nullable();
			$table->string('POST', 45)->nullable();
			$table->primary(['ID','EMAIL']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user');
	}

}
