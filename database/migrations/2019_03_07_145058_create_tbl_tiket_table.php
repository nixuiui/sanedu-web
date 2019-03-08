<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblTiketTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_tiket', function(Blueprint $table)
		{
			$table->char('id', 36)->primary();
			$table->integer('id_kategori_tiket');
			$table->char('id_cetak_tiket', 36);
			$table->char('id_simulasi', 36)->nullable();
			$table->bigInteger('kap');
			$table->bigInteger('pin');
			$table->char('id_user', 36)->nullable();
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
		Schema::drop('tbl_tiket');
	}

}
