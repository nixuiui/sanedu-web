<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblAttemptTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_attempt', function(Blueprint $table)
		{
			$table->char('id', 36)->primary();
			$table->dateTime('start_attempt');
			$table->dateTime('end_attempt');
			$table->char('id_ujian', 36)->nullable()->index('id_ujian');
			$table->char('id_pembelian', 36)->nullable()->index('id_pembelian');
			$table->char('id_peserta_simulasi', 36)->nullable();
			$table->char('id_user', 36)->nullable()->index('id_user');
			$table->boolean('jumlah_benar')->default(0);
			$table->boolean('jumlah_salah')->default(0);
			$table->boolean('jumlah_tidak_jawab')->default(0);
			$table->integer('nilai');
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
		Schema::drop('tbl_attempt');
	}

}
