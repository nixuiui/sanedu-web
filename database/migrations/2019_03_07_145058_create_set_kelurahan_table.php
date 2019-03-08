<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSetKelurahanTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('set_kelurahan', function(Blueprint $table)
		{
			$table->char('id', 10)->primary();
			$table->char('id_kecamatan', 7)->index('villages_district_id_index');
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
		Schema::drop('set_kelurahan');
	}

}
