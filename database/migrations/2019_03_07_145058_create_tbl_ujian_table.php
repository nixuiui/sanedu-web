<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblUjianTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_ujian', function(Blueprint $table)
		{
			$table->char('id', 36)->primary();
			$table->integer('id_tingkat_sekolah');
			$table->integer('id_jenis_ujian');
			$table->integer('id_tingkat_kelas')->nullable();
			$table->integer('id_mata_pelajaran')->nullable();
			$table->string('judul', 100);
			$table->text('peraturan', 65535)->nullable();
			$table->integer('durasi')->default(0);
			$table->integer('harga')->default(0);
			$table->integer('jumlah_soal')->default(0);
			$table->text('link_pembahasan', 65535)->nullable();
			$table->boolean('is_published')->default(0);
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
		Schema::drop('tbl_ujian');
	}

}
