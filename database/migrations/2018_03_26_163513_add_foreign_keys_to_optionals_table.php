<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToOptionalsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('optionals', function(Blueprint $table)
		{
			$table->foreign('BARCODE', 'FK_3')->references('BARCODE')->on('product')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('optionals', function(Blueprint $table)
		{
			$table->dropForeign('FK_3');
		});
	}

}
