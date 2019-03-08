<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblSekolahTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_sekolah', function(Blueprint $table)
		{
			$table->char('id', 36)->primary();
			$table->integer('id_tingkat_sekolah')->index('id_tingkat_sekolah');
			$table->string('nama', 50);
			$table->char('id_provinsi', 2)->index('id_provinsi');
			$table->char('id_kota', 4);
			$table->string('alamat', 100)->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_sekolah');
	}

}
