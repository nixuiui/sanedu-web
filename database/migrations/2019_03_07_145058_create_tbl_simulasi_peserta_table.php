<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblSimulasiPesertaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_simulasi_peserta', function(Blueprint $table)
		{
			$table->char('id', 36)->primary();
			$table->char('id_simulasi', 36);
			$table->char('id_ruang', 36)->nullable();
			$table->char('id_jadwal_online', 36)->nullable();
			$table->integer('id_mapel')->nullable();
			$table->char('id_user', 36);
			$table->enum('mode_simulasi', array('offline','online'));
			$table->string('no_peserta', 20);
			$table->integer('harga');
			$table->boolean('is_attempted')->default(0);
			$table->boolean('is_corrected')->default(0);
			$table->smallInteger('jumlah_benar')->default(0);
			$table->smallInteger('jumlah_salah')->default(0);
			$table->smallInteger('jumlah_tidak_jawab')->default(0);
			$table->float('nilai_akhir', 10, 0)->nullable();
			$table->smallInteger('peringkat')->nullable();
			$table->char('id_passing_grade_lolos', 36)->nullable();
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
		Schema::drop('tbl_simulasi_peserta');
	}

}
