<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblPilihanPassingGradeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_pilihan_passing_grade', function(Blueprint $table)
		{
			$table->char('id', 36)->primary();
			$table->char('id_attempt', 36)->nullable()->index();
			$table->char('id_ujian', 36)->nullable()->index();
			$table->char('id_simulasi', 36)->nullable()->index();
			$table->char('id_peserta', 36)->nullable();
			$table->char('pilihan_1', 36)->index();
			$table->char('pilihan_2', 36)->index();
			$table->char('pilihan_3', 36)->index();
			$table->integer('jurusan')->index();
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
		Schema::drop('tbl_pilihan_passing_grade');
	}

}
