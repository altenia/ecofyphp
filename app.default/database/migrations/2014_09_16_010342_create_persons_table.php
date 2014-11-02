<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('persons', function(Blueprint $table)
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
			$table->integer('user_sid');
			$table->string('id', 64);
			$table->string('ref_id', 64);
			$table->integer('head_of_family')->nullable();
			$table->string('primary_lang', 3)->nullable();
			$table->string('education_level', 64)->nullable();
			$table->text('highlight')->nullable();
			$table->text('philosophy')->nullable();
			$table->text('goals')->nullable();
			$table->string('personality_type', 255)->nullable();
			$table->string('location', 64);
			$table->string('permalink', 127);
			$table->string('country_cd', 3);
			$table->string('province_cd', 127);
			$table->string('district', 127);
			$table->string('address', 255);
			$table->string('postal_code', 64)->nullable();
			$table->string('additional_type', 64)->nullable();
			$table->string('alternate_name', 64)->nullable();
			$table->text('description')->nullable();
			$table->string('image', 255)->nullable();
			$table->string('name', 127)->nullable();
			$table->string('name_nl', 127)->nullable();
			$table->string('same_as', 127)->nullable();
			$table->string('url', 255)->nullable();
			$table->string('additional_name', 127)->nullable();
			$table->string('affiliation', 255)->nullable();
			$table->string('alumni_of', 127)->nullable();
			$table->string('award', 127)->nullable();
			$table->string('awards', 127)->nullable();
			$table->date('birth_date')->nullable();
			$table->string('brand', 64)->nullable();
			$table->string('children', 127)->nullable();
			$table->string('colleague', 127)->nullable();
			$table->string('colleagues', 127)->nullable();
			$table->string('contact_point', 64)->nullable();
			$table->string('contact_points', 64)->nullable();
			$table->date('death_date', 64)->nullable();
			$table->string('duns', 64)->nullable();
			$table->string('email', 127)->nullable();
			$table->string('family_name', 64)->nullable();
			$table->string('fax_number', 64)->nullable();
			$table->string('follows', 64)->nullable();
			$table->string('gender', 2)->nullable();
			$table->string('given_name', 64)->nullable();
			$table->string('global_location_number', 64)->nullable();
			$table->string('has_pos', 64)->nullable();
			$table->string('home_location', 255)->nullable();
			$table->string('honorific_prefix', 32)->nullable();
			$table->string('honorific_suffix', 32)->nullable();
			$table->string('interaction_count', 64)->nullable();
			$table->string('isic_v4', 64)->nullable();
			$table->string('job_title', 64)->nullable();
			$table->string('knows', 255)->nullable();
			$table->string('makes_offer', 255)->nullable();
			$table->string('member_of', 127)->nullable();
			$table->string('mobile_number', 64)->nullable();
			$table->string('naics', 64)->nullable();
			$table->string('nationality', 32)->nullable();
			$table->string('owns', 127)->nullable();
			$table->string('parent', 127)->nullable();
			$table->string('parents', 127)->nullable();
			$table->string('performer_in', 127)->nullable();
			$table->string('related_to', 127)->nullable();
			$table->string('seeks', 127)->nullable();
			$table->string('sibling', 127)->nullable();
			$table->string('siblings', 127)->nullable();
			$table->string('spouse', 127)->nullable();
			$table->string('tax_id', 64)->nullable();
			$table->string('telephone', 64)->nullable();
			$table->string('vat_id', 64)->nullable();
			$table->string('work_location', 127)->nullable();
			$table->string('works_for', 127)->nullable();
			$table->string('status', 32)->nullable();
			$table->text('params_text')->nullable();
		    $table->index('uuid');
		    $table->index('domain_id');
		    $table->index('created_by');
		    $table->unique('id');
		    $table->index('user_sid');
		    $table->index('ref_id');
		    $table->index('head_of_family');
		    $table->index('name_nl');
		    $table->index('given_name');
		    $table->index('family_name');
		    $table->index('country_cd');
		    $table->index('postal_code');
		    $table->unique('email');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('persons');
	}

}
