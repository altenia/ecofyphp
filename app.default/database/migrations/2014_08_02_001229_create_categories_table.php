<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('categories', function(Blueprint $table)
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
			$table->bigInteger('parent_sid')->nullable();
			$table->string('type', 255);
			$table->string('name', 255);
			$table->string('code', 255)->nullable();
			$table->text('description')->nullable();
			$table->string('image_url', 255)->nullable();
			$table->integer('position')->default('0');
			$table->text('params_text')->nullable();
		    $table->index('uuid');
		    $table->index('domain_id');
		    $table->index('created_by');
		    $table->index('parent_sid');
		    $table->index('type');
		    $table->index('name');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('categories');
	}

}
