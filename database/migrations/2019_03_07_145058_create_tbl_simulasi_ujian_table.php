<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblSimulasiUjianTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_simulasi_ujian', function(Blueprint $table)
		{
			$table->char('id', 36)->primary();
			$table->char('id_simulasi', 36);
			$table->char('id_ujian', 36)->nullable();
			$table->char('id_mapel', 36);
			$table->string('link_soal')->nullable();
			$table->string('link_pembahasan')->nullable();
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
		Schema::drop('tbl_simulasi_ujian');
	}

}
