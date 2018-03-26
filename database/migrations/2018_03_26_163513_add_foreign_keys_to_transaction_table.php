<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTransactionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('transaction', function(Blueprint $table)
		{
			$table->foreign('BARCODE_ID', 'FK_2')->references('BARCODE')->on('product')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('transaction', function(Blueprint $table)
		{
			$table->dropForeign('FK_2');
		});
	}

}
