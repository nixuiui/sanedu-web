<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblSimulasiJadwalOnlineTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_simulasi_jadwal_online', function(Blueprint $table)
		{
			$table->char('id', 36)->primary();
			$table->char('id_simulasi', 36)->index();
			$table->date('tanggal');
			$table->smallInteger('kapasitas')->default(0);
			$table->smallInteger('jumlah_peserta')->default(0);
			$table->boolean('is_full')->default(0);
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
		Schema::drop('tbl_simulasi_jadwal_online');
	}

}
