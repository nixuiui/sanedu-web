<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblJurusanTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_jurusan', function(Blueprint $table)
		{
			$table->char('id', 36)->primary();
			$table->char('id_universitas', 36)->index('id_universitas');
			$table->string('jurusan', 100)->nullable();
			$table->integer('kuota')->nullable();
			$table->integer('peminat')->nullable();
			$table->float('passing_grade', 10, 0)->nullable();
			$table->char('akreditasi', 2)->nullable();
			$table->boolean('soshum')->nullable();
			$table->boolean('saintek')->nullable();
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
		Schema::drop('tbl_jurusan');
	}

}
