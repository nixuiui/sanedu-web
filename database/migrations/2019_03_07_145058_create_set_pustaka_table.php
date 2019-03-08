<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSetPustakaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('set_pustaka', function(Blueprint $table)
		{
			$table->integer('id')->primary();
			$table->boolean('id_kategori')->index('id_kategori');
			$table->integer('id_parent')->nullable()->index('id_parent');
			$table->string('image', 100)->nullable();
			$table->string('nama', 100);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('set_pustaka');
	}

}
