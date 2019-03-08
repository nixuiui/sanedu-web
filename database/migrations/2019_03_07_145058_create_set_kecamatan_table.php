<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSetKecamatanTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('set_kecamatan', function(Blueprint $table)
		{
			$table->char('id', 7)->primary();
			$table->char('id_kabupaten', 4)->index('districts_id_index');
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
		Schema::drop('set_kecamatan');
	}

}
