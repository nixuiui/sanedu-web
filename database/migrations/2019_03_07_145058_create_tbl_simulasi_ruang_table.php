<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblSimulasiRuangTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_simulasi_ruang', function(Blueprint $table)
		{
			$table->char('id', 36)->primary();
			$table->char('id_simulasi', 36);
			$table->integer('id_mapel')->nullable();
			$table->string('nama', 100);
			$table->integer('kapasitas')->default(0);
			$table->integer('jumlah_peserta')->default(0);
			$table->boolean('is_full')->default(0);
			$table->string('alamat');
			$table->float('latitude', 10, 0)->nullable();
			$table->float('longitude', 10, 0)->nullable();
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
		Schema::drop('tbl_simulasi_ruang');
	}

}
