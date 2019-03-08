<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblSimulasiKunciJawabanTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_simulasi_kunci_jawaban', function(Blueprint $table)
		{
			$table->char('id', 36)->primary();
			$table->char('id_simulasi', 36);
			$table->integer('id_mapel')->nullable();
			$table->smallInteger('no');
			$table->enum('jawaban', array('a','b','c','d','e'));
			$table->smallInteger('jumlah_benar')->default(0);
			$table->smallInteger('jumlah_salah')->default(0);
			$table->enum('kriteria', array('sulit','sedang','mudah'))->nullable();
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_simulasi_kunci_jawaban');
	}

}
