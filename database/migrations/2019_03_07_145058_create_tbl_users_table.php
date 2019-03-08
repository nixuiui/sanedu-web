<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_users', function(Blueprint $table)
		{
			$table->char('id', 36)->primary();
			$table->integer('id_role');
			$table->string('nama', 100);
			$table->string('email', 100)->unique('email');
			$table->string('username', 100)->unique('username');
			$table->string('password', 100);
			$table->string('no_hp', 14)->nullable();
			$table->string('no_hp_ortu', 14)->nullable();
			$table->char('id_sekolah', 36)->nullable();
			$table->integer('id_kelas')->nullable();
			$table->string('alamat', 100)->nullable();
			$table->string('tempat_lahir', 100)->nullable();
			$table->date('tanggal_lahir')->nullable();
			$table->string('foto', 100)->nullable();
			$table->integer('saldo')->default(0);
			$table->integer('point')->default(0);
			$table->string('remember_token', 100)->nullable();
			$table->string('email_verification_code')->nullable();
			$table->boolean('email_is_verified')->nullable()->default(0);
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
		Schema::drop('tbl_users');
	}

}
