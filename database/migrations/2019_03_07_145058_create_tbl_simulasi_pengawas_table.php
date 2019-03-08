<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblSimulasiPengawasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_simulasi_pengawas', function(Blueprint $table)
		{
			$table->char('id', 36)->primary();
			$table->char('id_simulasi', 36);
			$table->char('id_user', 36);
			$table->char('id_ruang', 36)->nullable();
			$table->integer('id_mapel')->nullable();
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
		Schema::drop('tbl_simulasi_pengawas');
	}

}
