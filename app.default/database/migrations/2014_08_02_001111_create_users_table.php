<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->string('remember_token'); // used by Laravel
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
			$table->integer('organization_sid');
			$table->bigInteger('role_sid');
			$table->string('role_name', 128);
			$table->string('id', 64);
			$table->string('password', 64);
			$table->string('given_name', 255);
			$table->string('middle_name', 255)->nullable();
			$table->string('family_name', 255)->nullable();
			$table->string('name_nl', 255)->nullable();
			$table->string('name', 255);
			$table->date('dob')->nullable();
			$table->string('phone', 32)->nullable();
			$table->string('email', 64)->nullable();
			$table->string('timezone', 32)->nullable();
			$table->string('type', 16);
			$table->string('permalink', 64)->nullable();
			$table->string('profile_image_url', 255)->nullable();
			$table->string('activation_code', 64)->nullable();
			$table->string('security_question', 255)->nullable();
			$table->string('security_answer', 255)->nullable();
			$table->timestamp('session_timestamp')->nullable();
			$table->string('last_session_ip')->nullable();
			$table->dateTime('last_session_dt')->nullable();
			$table->integer('login_fail_counter')->default('0');
			$table->boolean('active')->default(true);
			$table->integer('status')->default('0');
			$table->string('default_lang_cd', 3)->nullable();
			$table->dateTime('expiry_dt')->nullable();
			$table->text('params_text')->nullable();
		    $table->index('uuid');
		    $table->index('domain_id');
		    $table->index('created_by');
		    $table->unique('id');
		    $table->index('organization_sid');
		    $table->unique('email');
		    $table->index('permalink');
		    //$table->foreign('organization_sid')->references('sid')->on('organizations');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('users');
	}

}
