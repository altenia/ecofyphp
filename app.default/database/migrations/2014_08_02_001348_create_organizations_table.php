<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('organizations', function(Blueprint $table)
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
			$table->bigInteger('owner_sid');
			$table->bigInteger('parent_sid')->nullable();
			$table->bigInteger('role_sid');
			$table->string('role_name', 128);
			$table->string('id', 128);
			$table->string('name', 128);
			$table->string('name_nl', 128)->nullable();
			$table->bigInteger('category_sid');
			$table->string('registration_type', 64);
			$table->string('registration_num', 128);
			$table->string('inet_domain_name', 64)->nullable();
			$table->string('url', 128)->nullable();
			$table->string('country_cd', 3);
			$table->string('province_cd', 127);
			$table->string('district', 127);
			$table->string('address', 255);
			$table->string('postal_code', 64)->nullable();
			$table->string('slogan', 64)->nullable();
			$table->text('summary');
			$table->text('description');
			$table->string('logo_image_uri', 255)->nullable();
			$table->string('cover_image_uri', 255)->nullable();
			$table->string('found_date', 6)->nullable();
			$table->integer('status')->default('0');
			$table->integer('num_members')->default('0');
			$table->integer('num_comments')->default('0');
			$table->integer('num_cheers')->default('0');
			$table->text('params_text')->nullable();
		    $table->index('uuid');
		    $table->index('domain_id');
		    $table->index('created_by');
		    $table->unique('id');
		    $table->index('name');
		    $table->index('category_sid');
		    $table->index('country_cd');
		    $table->index('province_cd');
		    $table->index('postal_code');
		    $table->index('status');
		    //$table->foreign('owner_sid')->references('sid')->on('users');
		    //$table->foreign('category_sid')->references('sid')->on('category');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('organizations');
	}

}
