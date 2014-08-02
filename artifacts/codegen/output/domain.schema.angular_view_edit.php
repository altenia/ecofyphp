
<!-- app/views/domain/edit.blade.php -->

@section('content')
<div class="container">

<div ng-controller="DocumentTypeFormCtrl">
<!-- @todo: properly set the field name to be displayed as title -->
<h1>Edit @{{ record.name }}</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

<!-- @todo: Make sure that the primaryKey column name is sid -->
{{ Form::model($record, array('route' => array('domains.update', $record->sid), 'method' => 'PUT', 'class' => 'form-horizontal')) }}

<!--
    @todo: Remove non-editable fields.
           Add client-side validation.
-->
	<div class="form-group">
		<label for="creator_sid" class="col-sm-2 control-label">{{ Lang::get('domain.creator_sid') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="creator_sid" type="text" value="@{{ record.creator_sid }}" id="creator_sid">
		</div>
	</div>
	<div class="form-group">
		<label for="created_dt" class="col-sm-2 control-label">{{ Lang::get('domain.created_dt') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="created_dt" type="text" value="@{{ record.created_dt }}" id="created_dt">
		</div>
	</div>
	<div class="form-group">
		<label for="updated_by" class="col-sm-2 control-label">{{ Lang::get('domain.updated_by') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="updated_by" type="text" value="@{{ record.updated_by }}" id="updated_by">
		</div>
	</div>
	<div class="form-group">
		<label for="updated_dt" class="col-sm-2 control-label">{{ Lang::get('domain.updated_dt') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="updated_dt" type="text" value="@{{ record.updated_dt }}" id="updated_dt">
		</div>
	</div>
	<div class="form-group">
		<label for="update_counter" class="col-sm-2 control-label">{{ Lang::get('domain.update_counter') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="update_counter" type="text" value="@{{ record.update_counter }}" id="update_counter">
		</div>
	</div>
	<div class="form-group">
		<label for="uuid" class="col-sm-2 control-label">{{ Lang::get('domain.uuid') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="uuid" type="text" value="@{{ record.uuid }}" id="uuid">
		</div>
	</div>
	<div class="form-group">
		<label for="lang" class="col-sm-2 control-label">{{ Lang::get('domain.lang') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="lang" type="text" value="@{{ record.lang }}" id="lang">
		</div>
	</div>
	<div class="form-group">
		<label for="owner_sid" class="col-sm-2 control-label">{{ Lang::get('domain.owner_sid') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="owner_sid" type="text" value="@{{ record.owner_sid }}" id="owner_sid">
		</div>
	</div>
	<div class="form-group">
		<label for="parent_sid" class="col-sm-2 control-label">{{ Lang::get('domain.parent_sid') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="parent_sid" type="text" value="@{{ record.parent_sid }}" id="parent_sid">
		</div>
	</div>
	<div class="form-group">
		<label for="category_sid" class="col-sm-2 control-label">{{ Lang::get('domain.category_sid') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="category_sid" type="text" value="@{{ record.category_sid }}" id="category_sid">
		</div>
	</div>
	<div class="form-group">
		<label for="id" class="col-sm-2 control-label">{{ Lang::get('domain.id') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="id" type="text" value="@{{ record.id }}" id="id">
		</div>
	</div>
	<div class="form-group">
		<label for="name" class="col-sm-2 control-label">{{ Lang::get('domain.name') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="name" type="text" value="@{{ record.name }}" id="name">
		</div>
	</div>
	<div class="form-group">
		<label for="name_lc" class="col-sm-2 control-label">{{ Lang::get('domain.name_lc') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="name_lc" type="text" value="@{{ record.name_lc }}" id="name_lc">
		</div>
	</div>
	<div class="form-group">
		<label for="intro" class="col-sm-2 control-label">{{ Lang::get('domain.intro') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="intro" type="text" value="@{{ record.intro }}" id="intro">
		</div>
	</div>
	<div class="form-group">
		<label for="description" class="col-sm-2 control-label">{{ Lang::get('domain.description') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="description" type="text" value="@{{ record.description }}" id="description">
		</div>
	</div>
	<div class="form-group">
		<label for="logo_image_url" class="col-sm-2 control-label">{{ Lang::get('domain.logo_image_url') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="logo_image_url" type="text" value="@{{ record.logo_image_url }}" id="logo_image_url">
		</div>
	</div>
	<div class="form-group">
		<label for="cover_image_url" class="col-sm-2 control-label">{{ Lang::get('domain.cover_image_url') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="cover_image_url" type="text" value="@{{ record.cover_image_url }}" id="cover_image_url">
		</div>
	</div>
	<div class="form-group">
		<label for="policy" class="col-sm-2 control-label">{{ Lang::get('domain.policy') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="policy" type="text" value="@{{ record.policy }}" id="policy">
		</div>
	</div>
	<div class="form-group">
		<label for="privacy_level" class="col-sm-2 control-label">{{ Lang::get('domain.privacy_level') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="privacy_level" type="text" value="@{{ record.privacy_level }}" id="privacy_level">
		</div>
	</div>
	<div class="form-group">
		<label for="type" class="col-sm-2 control-label">{{ Lang::get('domain.type') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="type" type="text" value="@{{ record.type }}" id="type">
		</div>
	</div>
	<div class="form-group">
		<label for="active" class="col-sm-2 control-label">{{ Lang::get('domain.active') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="active" type="text" value="@{{ record.active }}" id="active">
		</div>
	</div>
	<div class="form-group">
		<label for="status" class="col-sm-2 control-label">{{ Lang::get('domain.status') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="status" type="text" value="@{{ record.status }}" id="status">
		</div>
	</div>
	<div class="form-group">
		<label for="num_users" class="col-sm-2 control-label">{{ Lang::get('domain.num_users') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="num_users" type="text" value="@{{ record.num_users }}" id="num_users">
		</div>
	</div>
	<div class="form-group">
		<label for="num_organizations" class="col-sm-2 control-label">{{ Lang::get('domain.num_organizations') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="num_organizations" type="text" value="@{{ record.num_organizations }}" id="num_organizations">
		</div>
	</div>
	<div class="form-group">
		<label for="params_text" class="col-sm-2 control-label">{{ Lang::get('domain.params_text') }}</label>
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
