
<!-- app/views/domain/edit.blade.php -->

@section('content')
<div class="container">

<h1>Create New</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

// Make sure that the primaryKey column name is sid
{{ Form::open(array('url' => 'domains', 'class' => 'form-horizontal')) }}

	<div class="form-group">
		{{ Form::label('creator_sid', Lang::get('domain.creator_sid'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('creator_sid', Input::old('creator_sid'), array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('created_dt', Lang::get('domain.created_dt'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('created_dt', Input::old('created_dt'), array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('updated_by', Lang::get('domain.updated_by'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('updated_by', Input::old('updated_by'), array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('updated_dt', Lang::get('domain.updated_dt'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('updated_dt', Input::old('updated_dt'), array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('update_counter', Lang::get('domain.update_counter'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('update_counter', Input::old('update_counter'), array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('uuid', Lang::get('domain.uuid'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('uuid', Input::old('uuid'), array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('lang', Lang::get('domain.lang'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('lang', Input::old('lang'), array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('owner_sid', Lang::get('domain.owner_sid'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('owner_sid', Input::old('owner_sid'), array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('parent_sid', Lang::get('domain.parent_sid'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('parent_sid', Input::old('parent_sid'), array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('category_sid', Lang::get('domain.category_sid'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('category_sid', Input::old('category_sid'), array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('id', Lang::get('domain.id'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('id', Input::old('id'), array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('name', Lang::get('domain.name'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('name_lc', Lang::get('domain.name_lc'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('name_lc', Input::old('name_lc'), array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('intro', Lang::get('domain.intro'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('intro', Input::old('intro'), array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('description', Lang::get('domain.description'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('description', Input::old('description'), array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('logo_image_url', Lang::get('domain.logo_image_url'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('logo_image_url', Input::old('logo_image_url'), array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('cover_image_url', Lang::get('domain.cover_image_url'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('cover_image_url', Input::old('cover_image_url'), array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('policy', Lang::get('domain.policy'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('policy', Input::old('policy'), array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('privacy_level', Lang::get('domain.privacy_level'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('privacy_level', Input::old('privacy_level'), array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('type', Lang::get('domain.type'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('type', Input::old('type'), array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('active', Lang::get('domain.active'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('active', Input::old('active'), array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('status', Lang::get('domain.status'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('status', Input::old('status'), array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('num_users', Lang::get('domain.num_users'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('num_users', Input::old('num_users'), array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('num_organizations', Lang::get('domain.num_organizations'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('num_organizations', Input::old('num_organizations'), array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('params_text', Lang::get('domain.params_text'), array('class' => 'col-sm-2 control-label')) }}
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
