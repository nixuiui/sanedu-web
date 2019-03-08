<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblAttemptCorrectionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_attempt_correction', function(Blueprint $table)
		{
			$table->char('id', 36)->primary();
			$table->char('id_attempt', 36)->index('id_attempt');
			$table->enum('jawaban', array('a','b','c','d','e'));
			$table->boolean('is_correct')->default(0);
			$table->char('id_soal', 36)->index('id_soal');
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
		Schema::drop('tbl_attempt_correction');
	}

}
