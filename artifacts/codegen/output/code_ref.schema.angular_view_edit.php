
<!-- app/views/code_ref/edit.blade.php -->

@section('content')
<div class="container">

<div ng-controller="DocumentTypeFormCtrl">
<!-- @todo: properly set the field name to be displayed as title -->
<h1>Edit @{{ record.name }}</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

<!-- @todo: Make sure that the primaryKey column name is sid -->
{{ Form::model($record, array('route' => array('code_refs.update', $record->sid), 'method' => 'PUT', 'class' => 'form-horizontal')) }}

<!--
    @todo: Remove non-editable fields.
           Add client-side validation.
-->
	<div class="form-group">
		<label for="uuid" class="col-sm-2 control-label">{{ Lang::get('code_ref.uuid') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="uuid" type="text" value="@{{ record.uuid }}" id="uuid">
		</div>
	</div>
	<div class="form-group">
		<label for="domain_sid" class="col-sm-2 control-label">{{ Lang::get('code_ref.domain_sid') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="domain_sid" type="text" value="@{{ record.domain_sid }}" id="domain_sid">
		</div>
	</div>
	<div class="form-group">
		<label for="domain_id" class="col-sm-2 control-label">{{ Lang::get('code_ref.domain_id') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="domain_id" type="text" value="@{{ record.domain_id }}" id="domain_id">
		</div>
	</div>
	<div class="form-group">
		<label for="created_by" class="col-sm-2 control-label">{{ Lang::get('code_ref.created_by') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="created_by" type="text" value="@{{ record.created_by }}" id="created_by">
		</div>
	</div>
	<div class="form-group">
		<label for="created_dt" class="col-sm-2 control-label">{{ Lang::get('code_ref.created_dt') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="created_dt" type="text" value="@{{ record.created_dt }}" id="created_dt">
		</div>
	</div>
	<div class="form-group">
		<label for="updated_by" class="col-sm-2 control-label">{{ Lang::get('code_ref.updated_by') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="updated_by" type="text" value="@{{ record.updated_by }}" id="updated_by">
		</div>
	</div>
	<div class="form-group">
		<label for="updated_dt" class="col-sm-2 control-label">{{ Lang::get('code_ref.updated_dt') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="updated_dt" type="text" value="@{{ record.updated_dt }}" id="updated_dt">
		</div>
	</div>
	<div class="form-group">
		<label for="update_counter" class="col-sm-2 control-label">{{ Lang::get('code_ref.update_counter') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="update_counter" type="text" value="@{{ record.update_counter }}" id="update_counter">
		</div>
	</div>
	<div class="form-group">
		<label for="lang" class="col-sm-2 control-label">{{ Lang::get('code_ref.lang') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="lang" type="text" value="@{{ record.lang }}" id="lang">
		</div>
	</div>
	<div class="form-group">
		<label for="parent_sid" class="col-sm-2 control-label">{{ Lang::get('code_ref.parent_sid') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="parent_sid" type="text" value="@{{ record.parent_sid }}" id="parent_sid">
		</div>
	</div>
	<div class="form-group">
		<label for="kind" class="col-sm-2 control-label">{{ Lang::get('code_ref.kind') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="kind" type="text" value="@{{ record.kind }}" id="kind">
		</div>
	</div>
	<div class="form-group">
		<label for="name" class="col-sm-2 control-label">{{ Lang::get('code_ref.name') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="name" type="text" value="@{{ record.name }}" id="name">
		</div>
	</div>
	<div class="form-group">
		<label for="code" class="col-sm-2 control-label">{{ Lang::get('code_ref.code') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="code" type="text" value="@{{ record.code }}" id="code">
		</div>
	</div>
	<div class="form-group">
		<label for="abbreviation" class="col-sm-2 control-label">{{ Lang::get('code_ref.abbreviation') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="abbreviation" type="text" value="@{{ record.abbreviation }}" id="abbreviation">
		</div>
	</div>
	<div class="form-group">
		<label for="description" class="col-sm-2 control-label">{{ Lang::get('code_ref.description') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="description" type="text" value="@{{ record.description }}" id="description">
		</div>
	</div>
	<div class="form-group">
		<label for="position" class="col-sm-2 control-label">{{ Lang::get('code_ref.position') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="position" type="text" value="@{{ record.position }}" id="position">
		</div>
	</div>
	<div class="form-group">
		<label for="params_text" class="col-sm-2 control-label">{{ Lang::get('code_ref.params_text') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="params_text" type="text" value="@{{ record.params_text }}" id="params_text">
		</div>
	</div>

	<div class="form-group">
    	<div class="col-sm-offset-2 col-sm-10">
	{{ Form::submit('Update', array('class' => 'btn btn-primary')) }}
	    </div>
	</div>

{{ Form::close() }}
</div> <!-- angular controller -->

<script>
angular.module('myApp', []).config(function($interpolateProvider){
        $interpolateProvider.startSymbol(').endSymbol(');
    }
);

function DocumentTypeFormCtrl($scope) {
	$scope.record = {{ $json_model }};
	
	$scope.update = function() {
	};
}
</script>

</div> <!-- container -->
@show
