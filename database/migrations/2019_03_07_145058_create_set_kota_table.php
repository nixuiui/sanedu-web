<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSetKotaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('set_kota', function(Blueprint $table)
		{
			$table->char('id', 4)->primary();
			$table->char('id_provinsi', 2)->index('regencies_province_id_index');
			$table->string('name');
			$table->boolean('isEnabled');
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
		Schema::drop('set_kota');
	}

}
