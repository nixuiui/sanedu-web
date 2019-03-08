<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblSimulasiKoreksiTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_simulasi_koreksi', function(Blueprint $table)
		{
			$table->char('id', 36)->primary();
			$table->char('id_simulasi', 36)->index();
			$table->char('id_peserta', 36)->index();
			$table->char('id_soal', 36)->index();
			$table->smallInteger('no_soal');
			$table->enum('kriteria', array('sulit','sedang','mudah'))->nullable();
			$table->enum('kunci_jawaban', array('a','b','c','d','e'))->nullable();
			$table->enum('jawaban', array('a','b','c','d','e'))->nullable();
			$table->boolean('is_correct')->default(0);
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
		Schema::drop('tbl_simulasi_koreksi');
	}

}
