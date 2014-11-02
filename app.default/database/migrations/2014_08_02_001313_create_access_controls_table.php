<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccessControlsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('access_controls', function(Blueprint $table)
		{
			$table->increments('sid');
			$table->string('uuid', 128);
			$table->bigInteger('domain_sid')->nullable();
			$table->string('domain_id', 64);
			$table->bigInteger('created_by');
			$table->dateTime('created_dt');
			$table->bigInteger('updated_by');
			$table->dateTime('updated_dt');
			$table->integer('update_counter');
			$table->string('lang', 3);
			$table->bigInteger('role_sid');
			$table->string('service', 64);
			$table->text('permissions');
			$table->text('policy');
			$table->text('params_text')->nullable();
		    $table->index('uuid');
		    $table->index('domain_id');
		    $table->index('created_by');
		    $table->index('role_sid');
		    $table->index('service');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('access_controls');
	}

}
