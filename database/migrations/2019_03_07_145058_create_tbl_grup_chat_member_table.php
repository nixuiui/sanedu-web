<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblGrupChatMemberTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_grup_chat_member', function(Blueprint $table)
		{
			$table->char('id', 36)->primary();
			$table->char('id_user', 36);
			$table->char('id_grup_chat', 36)->nullable()->index('id_grup_chat');
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
		Schema::drop('tbl_grup_chat_member');
	}

}
