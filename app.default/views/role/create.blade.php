
<!-- app/views/role/edit.blade.php -->

@section('content')
<div class="container">

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::open(array('url' => 'roles', 'class' => 'form-horizontal')) }}

	<div class="form-group">
		{{ Form::label('subject_type', Lang::get('role.subject_type'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
			<?php  $subject_type_options = array('organization' => Lang::get('organization._name'), 'user' => Lang::get('user._name')) ?>
		    {{ Form::select('subject_type', $subject_type_options, Input::old('subject_type'), array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('name', Lang::get('role.name'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('params_text', Lang::get('role.params_text'), array('class' => 'col-sm-2 control-label')) }}
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
