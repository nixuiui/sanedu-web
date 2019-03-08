<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblInformasiTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_informasi', function(Blueprint $table)
		{
			$table->char('id', 36)->primary();
			$table->integer('id_kategori')->index();
			$table->char('id_author', 36)->index('id_author');
			$table->text('judul', 65535);
			$table->text('foto', 65535)->nullable();
			$table->text('isi', 65535);
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
		Schema::drop('tbl_informasi');
	}

}
