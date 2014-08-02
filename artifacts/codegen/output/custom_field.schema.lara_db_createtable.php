<?php

/**
 * Migration from schema: ecofy version 0.1
 * Code generated by TransformTask
 *
 */
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Issue this command: $php artisan migrate:make create_custom_field_table --create=custom_field
 * Then copy/paste the content to the file generated on app/database/migrations/<timestamp>-create_custom_field_table.php
 * To run the migration script do: $php artisan migrate
 */
class CreateCustomFieldsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('custom_fields', function(Blueprint $table)
		{
			$table->increments('sid');
			$table->bigInteger('domain_sid')->nullable();
			$table->string('type', 255);
			$table->string('field_name', 255);
			$table->string('data_type', 12);
			$table->string('value', 255);
		    $table->index('domain_sid');
		    $table->index('type');
		    $table->index('name');
		    $table->index('value');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('custom_fields');
	}

}