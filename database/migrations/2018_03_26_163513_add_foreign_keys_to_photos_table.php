<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPhotosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('photos', function(Blueprint $table)
		{
			$table->foreign('BARCODE', 'FK_4')->references('BARCODE')->on('product')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('photos', function(Blueprint $table)
		{
			$table->dropForeign('FK_4');
		});
	}

}
