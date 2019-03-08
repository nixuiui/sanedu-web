<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblSimulasiAgendaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_simulasi_agenda', function(Blueprint $table)
		{
			$table->char('id', 36)->primary();
			$table->char('id_simulasi', 36)->index();
			$table->string('nama_agenda', 100);
			$table->time('waktu_mulai');
			$table->time('waktu_selesai');
			$table->string('tempat', 100)->nullable();
			$table->text('deskripsi', 65535)->nullable();
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
		Schema::drop('tbl_simulasi_agenda');
	}

}
