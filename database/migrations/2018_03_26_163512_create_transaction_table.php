<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTransactionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('transaction', function(Blueprint $table)
		{
			$table->integer('ID', true);
			$table->integer('USER_ID')->nullable();
			$table->integer('BARCODE_ID')->nullable()->index('FK_2_idx');
			$table->dateTime('START_DATE')->nullable();
			$table->dateTime('END_DATE')->nullable();
			$table->string('STATUS', 45)->nullable();
			$table->string('REASON', 45)->nullable();
			$table->string('REPORT', 45)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('transaction');
	}

}
