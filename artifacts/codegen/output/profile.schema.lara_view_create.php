
<!-- app/views/user/edit.blade.php -->

@section('content')
<div class="container">

<h1>Create New</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

// Make sure that the primaryKey column name is sid
{{ Form::open(array('url' => 'users', 'class' => 'form-horizontal')) }}

	<div class="form-group">
		{{ Form::label('uuid', Lang::get('user.uuid'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('uuid', Input::old('uuid'), array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('domain_sid', Lang::get('user.domain_sid'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('domain_sid', Input::old('domain_sid'), array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('domain_id', Lang::get('user.domain_id'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('domain_id', Input::old('domain_id'), array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('created_by', Lang::get('user.created_by'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('created_by', Input::old('created_by'), array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('created_dt', Lang::get('user.created_dt'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('created_dt', Input::old('created_dt'), array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('updated_by', Lang::get('user.updated_by'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('updated_by', Input::old('updated_by'), array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('updated_dt', Lang::get('user.updated_dt'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('updated_dt', Input::old('updated_dt'), array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('update_counter', Lang::get('user.update_counter'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('update_counter', Input::old('update_counter'), array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('lang', Lang::get('user.lang'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('lang', Input::old('lang'), array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('user_sid', Lang::get('user.user_sid'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('user_sid', Input::old('user_sid'), array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('first_name', Lang::get('user.first_name'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('first_name', Input::old('first_name'), array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('middle_name', Lang::get('user.middle_name'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('middle_name', Input::old('middle_name'), array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('last_name', Lang::get('user.last_name'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('last_name', Input::old('last_name'), array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('lc_name', Lang::get('user.lc_name'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('lc_name', Input::old('lc_name'), array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('alt_name', Lang::get('user.alt_name'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('alt_name', Input::old('alt_name'), array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('primary_lang', Lang::get('user.primary_lang'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('primary_lang', Input::old('primary_lang'), array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('nationality_cd', Lang::get('user.nationality_cd'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('nationality_cd', Input::old('nationality_cd'), array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('hometown', Lang::get('user.hometown'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('hometown', Input::old('hometown'), array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('gender', Lang::get('user.gender'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('gender', Input::old('gender'), array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('dob', Lang::get('user.dob'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('dob', Input::old('dob'), array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('education_level', Lang::get('user.education_level'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('education_level', Input::old('education_level'), array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('highlight', Lang::get('user.highlight'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('highlight', Input::old('highlight'), array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('philosophy', Lang::get('user.philosophy'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('philosophy', Input::old('philosophy'), array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('goals', Lang::get('user.goals'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('goals', Input::old('goals'), array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('personality_type', Lang::get('user.personality_type'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('personality_type', Input::old('personality_type'), array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('location', Lang::get('user.location'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('location', Input::old('location'), array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('country_cd', Lang::get('user.country_cd'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('country_cd', Input::old('country_cd'), array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('province_cd', Lang::get('user.province_cd'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('province_cd', Input::old('province_cd'), array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('district', Lang::get('user.district'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('district', Input::old('district'), array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('address', Lang::get('user.address'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('address', Input::old('address'), array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('postal_code', Lang::get('user.postal_code'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('postal_code', Input::old('postal_code'), array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('privacy_level', Lang::get('user.privacy_level'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('privacy_level', Input::old('privacy_level'), array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('activity_index', Lang::get('user.activity_index'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('activity_index', Input::old('activity_index'), array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('params_text', Lang::get('user.params_text'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('params_text', Input::old('params_text'), array('class' => 'form-control')) }}
		</div>
	</div>

	<div class="form-group">
    	<div class="col-sm-offset-2 col-sm-10">
	{{ Form::submit('Create', array('class' => 'btn btn-primary')) }}
	    </div>
	</div>

{{ Form::close() }}

</div> <!-- container -->
@show
