<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblSoalTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_soal', function(Blueprint $table)
		{
			$table->char('id', 36);
			$table->text('soal', 16777215);
			$table->text('a', 16777215)->nullable();
			$table->text('b', 16777215)->nullable();
			$table->text('c', 16777215)->nullable();
			$table->text('d', 16777215)->nullable();
			$table->text('e', 16777215)->nullable();
			$table->enum('jawaban', array('a','b','c','d','e'));
			$table->char('id_ujian', 36);
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
		Schema::drop('tbl_soal');
	}

}
