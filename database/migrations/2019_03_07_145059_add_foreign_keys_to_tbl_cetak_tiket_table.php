<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTblCetakTiketTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tbl_cetak_tiket', function(Blueprint $table)
		{
			$table->foreign('id_kategori_tiket', 'tbl_cetak_tiket_ibfk_1')->references('id')->on('set_pustaka')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tbl_cetak_tiket', function(Blueprint $table)
		{
			$table->dropForeign('tbl_cetak_tiket_ibfk_1');
		});
	}

}
