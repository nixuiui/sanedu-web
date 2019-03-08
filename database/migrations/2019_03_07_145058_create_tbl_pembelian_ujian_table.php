<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblPembelianUjianTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_pembelian_ujian', function(Blueprint $table)
		{
			$table->char('id', 36)->primary();
			$table->char('id_ujian', 36)->index();
			$table->char('id_user', 36)->index();
			$table->integer('harga');
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
		Schema::drop('tbl_pembelian_ujian');
	}

}
