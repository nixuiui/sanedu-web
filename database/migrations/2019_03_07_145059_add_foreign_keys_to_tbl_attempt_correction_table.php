<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTblAttemptCorrectionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tbl_attempt_correction', function(Blueprint $table)
		{
			$table->foreign('id_attempt', 'tbl_attempt_correction_ibfk_1')->references('id')->on('tbl_attempt')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tbl_attempt_correction', function(Blueprint $table)
		{
			$table->dropForeign('tbl_attempt_correction_ibfk_1');
		});
	}

}
