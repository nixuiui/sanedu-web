<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTblGrupChatMemberTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tbl_grup_chat_member', function(Blueprint $table)
		{
			$table->foreign('id_user', 'tbl_grup_chat_member_ibfk_1')->references('id')->on('tbl_users')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('id_grup_chat', 'tbl_grup_chat_member_ibfk_3')->references('id')->on('tbl_grup_chat')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tbl_grup_chat_member', function(Blueprint $table)
		{
			$table->dropForeign('tbl_grup_chat_member_ibfk_1');
			$table->dropForeign('tbl_grup_chat_member_ibfk_3');
		});
	}

}
