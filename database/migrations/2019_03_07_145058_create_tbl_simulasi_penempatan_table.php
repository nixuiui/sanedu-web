<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblSimulasiPenempatanTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_simulasi_penempatan', function(Blueprint $table)
		{
			$table->char('id', 36);
			$table->char('id_peserta', 36);
			$table->char('id_ruang', 36);
			$table->char('id_simulasi', 36);
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
		Schema::drop('tbl_simulasi_penempatan');
	}

}
