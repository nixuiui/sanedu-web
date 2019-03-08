<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblRiwayatSaldoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_riwayat_saldo', function(Blueprint $table)
		{
			$table->char('id', 36)->primary();
			$table->char('id_user', 36)->index();
			$table->integer('deb_cr');
			$table->integer('saldo');
			$table->integer('id_kategori')->nullable()->index();
			$table->char('id_object', 36)->nullable()->index();
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
		Schema::drop('tbl_riwayat_saldo');
	}

}
