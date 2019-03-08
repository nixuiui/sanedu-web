<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblCetakTiketTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_cetak_tiket', function(Blueprint $table)
		{
			$table->char('id', 36)->primary();
			$table->integer('id_kategori_tiket')->index('id_kategori_tiket');
			$table->char('id_user', 36)->nullable();
			$table->char('id_simulasi', 36)->nullable()->index('id_simulasi');
			$table->integer('jumlah_tiket')->default(0);
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
		Schema::drop('tbl_cetak_tiket');
	}

}
