<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblSimulasiTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_simulasi', function(Blueprint $table)
		{
			$table->char('id', 36)->primary();
			$table->char('id_creator', 36)->index('id_creator');
			$table->integer('id_tingkat_sekolah')->index('id_jenis_ujian');
			$table->integer('id_jenis_ujian')->nullable()->index('id_jenis_ujian_2');
			$table->integer('id_status')->default(0);
			$table->string('judul', 100);
			$table->boolean('is_online')->default(0);
			$table->boolean('is_offline')->default(0);
			$table->string('instansi', 100);
			$table->string('featured_image', 100)->nullable();
			$table->date('tanggal_pelaksanaan');
			$table->string('tempat_pelaksanaan', 100);
			$table->date('tanggal_pengumuman')->nullable();
			$table->integer('harga')->default(0);
			$table->string('link_soal')->nullable();
			$table->string('link_pembahasan')->nullable();
			$table->integer('jumlah_peserta')->default(0);
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
		Schema::drop('tbl_simulasi');
	}

}
