
<!-- app/views/comment/edit.blade.php -->

@section('content')
<div class="container">

<div ng-controller="DocumentTypeFormCtrl">
<!-- @todo: properly set the field name to be displayed as title -->
<h1>Edit @{{ record.name }}</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

<!-- @todo: Make sure that the primaryKey column name is sid -->
{{ Form::model($record, array('route' => array('comments.update', $record->sid), 'method' => 'PUT', 'class' => 'form-horizontal')) }}

<!--
    @todo: Remove non-editable fields.
           Add client-side validation.
-->
	<div class="form-group">
		<label for="uuid" class="col-sm-2 control-label">{{ Lang::get('comment.uuid') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="uuid" type="text" value="@{{ record.uuid }}" id="uuid">
		</div>
	</div>
	<div class="form-group">
		<label for="domain_sid" class="col-sm-2 control-label">{{ Lang::get('comment.domain_sid') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="domain_sid" type="text" value="@{{ record.domain_sid }}" id="domain_sid">
		</div>
	</div>
	<div class="form-group">
		<label for="domain_id" class="col-sm-2 control-label">{{ Lang::get('comment.domain_id') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="domain_id" type="text" value="@{{ record.domain_id }}" id="domain_id">
		</div>
	</div>
	<div class="form-group">
		<label for="created_by" class="col-sm-2 control-label">{{ Lang::get('comment.created_by') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="created_by" type="text" value="@{{ record.created_by }}" id="created_by">
		</div>
	</div>
	<div class="form-group">
		<label for="created_dt" class="col-sm-2 control-label">{{ Lang::get('comment.created_dt') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="created_dt" type="text" value="@{{ record.created_dt }}" id="created_dt">
		</div>
	</div>
	<div class="form-group">
		<label for="updated_by" class="col-sm-2 control-label">{{ Lang::get('comment.updated_by') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="updated_by" type="text" value="@{{ record.updated_by }}" id="updated_by">
		</div>
	</div>
	<div class="form-group">
		<label for="updated_dt" class="col-sm-2 control-label">{{ Lang::get('comment.updated_dt') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="updated_dt" type="text" value="@{{ record.updated_dt }}" id="updated_dt">
		</div>
	</div>
	<div class="form-group">
		<label for="update_counter" class="col-sm-2 control-label">{{ Lang::get('comment.update_counter') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="update_counter" type="text" value="@{{ record.update_counter }}" id="update_counter">
		</div>
	</div>
	<div class="form-group">
		<label for="lang" class="col-sm-2 control-label">{{ Lang::get('comment.lang') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="lang" type="text" value="@{{ record.lang }}" id="lang">
		</div>
	</div>
	<div class="form-group">
		<label for="object_type" class="col-sm-2 control-label">{{ Lang::get('comment.object_type') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="object_type" type="text" value="@{{ record.object_type }}" id="object_type">
		</div>
	</div>
	<div class="form-group">
		<label for="object_sid" class="col-sm-2 control-label">{{ Lang::get('comment.object_sid') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="object_sid" type="text" value="@{{ record.object_sid }}" id="object_sid">
		</div>
	</div>
	<div class="form-group">
		<label for="title" class="col-sm-2 control-label">{{ Lang::get('comment.title') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="title" type="text" value="@{{ record.title }}" id="title">
		</div>
	</div>
	<div class="form-group">
		<label for="content" class="col-sm-2 control-label">{{ Lang::get('comment.content') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="content" type="text" value="@{{ record.content }}" id="content">
		</div>
	</div>
	<div class="form-group">
		<label for="attachments" class="col-sm-2 control-label">{{ Lang::get('comment.attachments') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="attachments" type="text" value="@{{ record.attachments }}" id="attachments">
		</div>
	</div>
	<div class="form-group">
		<label for="privacy_level" class="col-sm-2 control-label">{{ Lang::get('comment.privacy_level') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="privacy_level" type="text" value="@{{ record.privacy_level }}" id="privacy_level">
		</div>
	</div>
	<div class="form-group">
		<label for="params_text" class="col-sm-2 control-label">{{ Lang::get('comment.params_text') }}</label>
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
