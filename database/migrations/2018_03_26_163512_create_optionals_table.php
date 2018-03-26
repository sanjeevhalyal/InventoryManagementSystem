<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOptionalsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('optionals', function(Blueprint $table)
		{
			$table->integer('OPT_BARCODE')->primary();
			$table->integer('BARCODE')->nullable()->index('FK_1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('optionals');
	}

}
