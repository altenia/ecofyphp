<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDomainsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('domains', function(Blueprint $table)
		{
			$table->increments('sid');
			$table->string('uuid', 128);
			$table->bigInteger('created_by');
			$table->dateTime('created_dt');
			$table->bigInteger('updated_by');
			$table->dateTime('updated_dt');
			$table->integer('update_counter');
			$table->string('lang', 3);
			$table->bigInteger('owner_sid');
			$table->bigInteger('parent_sid')->nullable();
			$table->bigInteger('category_sid');
			$table->string('id', 64);
			$table->string('name', 128);
			$table->string('name_nl', 128)->nullable();
			$table->text('intro')->nullable();
			$table->text('description')->nullable();
			$table->string('logo_image_url', 255)->nullable();
			$table->string('cover_image_url', 255)->nullable();
			$table->text('policy')->nullable();
			$table->integer('privacy_level')->nullable();
			$table->string('type', 16);
			$table->boolean('active')->default(true);
			$table->integer('status')->default('0');
			$table->integer('num_users')->default('0');
			$table->integer('num_organizations')->default('0');
			$table->text('params_text')->nullable();
		    $table->index('uuid');
		    $table->index('created_by');
		    $table->unique('id');
		    $table->index('owner_sid');
		    $table->index('name');
		    $table->index('category_sid');
		    $table->index('active');
		    $table->index('status');
		    //$table->foreign('owner_sid')->references('sid')->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('domains');
	}

}
