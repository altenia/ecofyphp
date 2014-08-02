
<!-- app/views/custom_field/edit.blade.php -->

@section('content')
<div class="container">

<div ng-controller="DocumentTypeFormCtrl">
<!-- @todo: properly set the field name to be displayed as title -->
<h1>Edit @{{ record.name }}</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

<!-- @todo: Make sure that the primaryKey column name is sid -->
{{ Form::model($record, array('route' => array('custom_fields.update', $record->sid), 'method' => 'PUT', 'class' => 'form-horizontal')) }}

<!--
    @todo: Remove non-editable fields.
           Add client-side validation.
-->
	<div class="form-group">
		<label for="domain_sid" class="col-sm-2 control-label">{{ Lang::get('custom_field.domain_sid') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="domain_sid" type="text" value="@{{ record.domain_sid }}" id="domain_sid">
		</div>
	</div>
	<div class="form-group">
		<label for="type" class="col-sm-2 control-label">{{ Lang::get('custom_field.type') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="type" type="text" value="@{{ record.type }}" id="type">
		</div>
	</div>
	<div class="form-group">
		<label for="field_name" class="col-sm-2 control-label">{{ Lang::get('custom_field.field_name') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="field_name" type="text" value="@{{ record.field_name }}" id="field_name">
		</div>
	</div>
	<div class="form-group">
		<label for="data_type" class="col-sm-2 control-label">{{ Lang::get('custom_field.data_type') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="data_type" type="text" value="@{{ record.data_type }}" id="data_type">
		</div>
	</div>
	<div class="form-group">
		<label for="value" class="col-sm-2 control-label">{{ Lang::get('custom_field.value') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="value" type="text" value="@{{ record.value }}" id="value">
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
