
<!-- app/views/organization/edit.blade.php -->

@section('content')
<div class="container">

<div ng-controller="DocumentTypeFormCtrl">
<!-- @todo: properly set the field name to be displayed as title -->
<h1>Edit @{{ record.name }}</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

<!-- @todo: Make sure that the primaryKey column name is sid -->
{{ Form::model($record, array('route' => array('organizations.update', $record->sid), 'method' => 'PUT', 'class' => 'form-horizontal')) }}

<!--
    @todo: Remove non-editable fields.
           Add client-side validation.
-->
	<div class="form-group">
		<label for="uuid" class="col-sm-2 control-label">{{ Lang::get('organization.uuid') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="uuid" type="text" value="@{{ record.uuid }}" id="uuid">
		</div>
	</div>
	<div class="form-group">
		<label for="domain_sid" class="col-sm-2 control-label">{{ Lang::get('organization.domain_sid') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="domain_sid" type="text" value="@{{ record.domain_sid }}" id="domain_sid">
		</div>
	</div>
	<div class="form-group">
		<label for="domain_id" class="col-sm-2 control-label">{{ Lang::get('organization.domain_id') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="domain_id" type="text" value="@{{ record.domain_id }}" id="domain_id">
		</div>
	</div>
	<div class="form-group">
		<label for="created_by" class="col-sm-2 control-label">{{ Lang::get('organization.created_by') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="created_by" type="text" value="@{{ record.created_by }}" id="created_by">
		</div>
	</div>
	<div class="form-group">
		<label for="created_dt" class="col-sm-2 control-label">{{ Lang::get('organization.created_dt') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="created_dt" type="text" value="@{{ record.created_dt }}" id="created_dt">
		</div>
	</div>
	<div class="form-group">
		<label for="updated_by" class="col-sm-2 control-label">{{ Lang::get('organization.updated_by') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="updated_by" type="text" value="@{{ record.updated_by }}" id="updated_by">
		</div>
	</div>
	<div class="form-group">
		<label for="updated_dt" class="col-sm-2 control-label">{{ Lang::get('organization.updated_dt') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="updated_dt" type="text" value="@{{ record.updated_dt }}" id="updated_dt">
		</div>
	</div>
	<div class="form-group">
		<label for="update_counter" class="col-sm-2 control-label">{{ Lang::get('organization.update_counter') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="update_counter" type="text" value="@{{ record.update_counter }}" id="update_counter">
		</div>
	</div>
	<div class="form-group">
		<label for="lang" class="col-sm-2 control-label">{{ Lang::get('organization.lang') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="lang" type="text" value="@{{ record.lang }}" id="lang">
		</div>
	</div>
	<div class="form-group">
		<label for="owner_sid" class="col-sm-2 control-label">{{ Lang::get('organization.owner_sid') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="owner_sid" type="text" value="@{{ record.owner_sid }}" id="owner_sid">
		</div>
	</div>
	<div class="form-group">
		<label for="parent_sid" class="col-sm-2 control-label">{{ Lang::get('organization.parent_sid') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="parent_sid" type="text" value="@{{ record.parent_sid }}" id="parent_sid">
		</div>
	</div>
	<div class="form-group">
		<label for="role_sid" class="col-sm-2 control-label">{{ Lang::get('organization.role_sid') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="role_sid" type="text" value="@{{ record.role_sid }}" id="role_sid">
		</div>
	</div>
	<div class="form-group">
		<label for="role_name" class="col-sm-2 control-label">{{ Lang::get('organization.role_name') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="role_name" type="text" value="@{{ record.role_name }}" id="role_name">
		</div>
	</div>
	<div class="form-group">
		<label for="id" class="col-sm-2 control-label">{{ Lang::get('organization.id') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="id" type="text" value="@{{ record.id }}" id="id">
		</div>
	</div>
	<div class="form-group">
		<label for="name" class="col-sm-2 control-label">{{ Lang::get('organization.name') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="name" type="text" value="@{{ record.name }}" id="name">
		</div>
	</div>
	<div class="form-group">
		<label for="name_lc" class="col-sm-2 control-label">{{ Lang::get('organization.name_lc') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="name_lc" type="text" value="@{{ record.name_lc }}" id="name_lc">
		</div>
	</div>
	<div class="form-group">
		<label for="category_sid" class="col-sm-2 control-label">{{ Lang::get('organization.category_sid') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="category_sid" type="text" value="@{{ record.category_sid }}" id="category_sid">
		</div>
	</div>
	<div class="form-group">
		<label for="registration_type" class="col-sm-2 control-label">{{ Lang::get('organization.registration_type') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="registration_type" type="text" value="@{{ record.registration_type }}" id="registration_type">
		</div>
	</div>
	<div class="form-group">
		<label for="registration_num" class="col-sm-2 control-label">{{ Lang::get('organization.registration_num') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="registration_num" type="text" value="@{{ record.registration_num }}" id="registration_num">
		</div>
	</div>
	<div class="form-group">
		<label for="inet_domain_name" class="col-sm-2 control-label">{{ Lang::get('organization.inet_domain_name') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="inet_domain_name" type="text" value="@{{ record.inet_domain_name }}" id="inet_domain_name">
		</div>
	</div>
	<div class="form-group">
		<label for="url" class="col-sm-2 control-label">{{ Lang::get('organization.url') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="url" type="text" value="@{{ record.url }}" id="url">
		</div>
	</div>
	<div class="form-group">
		<label for="country_cd" class="col-sm-2 control-label">{{ Lang::get('organization.country_cd') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="country_cd" type="text" value="@{{ record.country_cd }}" id="country_cd">
		</div>
	</div>
	<div class="form-group">
		<label for="province_cd" class="col-sm-2 control-label">{{ Lang::get('organization.province_cd') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="province_cd" type="text" value="@{{ record.province_cd }}" id="province_cd">
		</div>
	</div>
	<div class="form-group">
		<label for="district" class="col-sm-2 control-label">{{ Lang::get('organization.district') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="district" type="text" value="@{{ record.district }}" id="district">
		</div>
	</div>
	<div class="form-group">
		<label for="address" class="col-sm-2 control-label">{{ Lang::get('organization.address') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="address" type="text" value="@{{ record.address }}" id="address">
		</div>
	</div>
	<div class="form-group">
		<label for="postal_code" class="col-sm-2 control-label">{{ Lang::get('organization.postal_code') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="postal_code" type="text" value="@{{ record.postal_code }}" id="postal_code">
		</div>
	</div>
	<div class="form-group">
		<label for="slogan" class="col-sm-2 control-label">{{ Lang::get('organization.slogan') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="slogan" type="text" value="@{{ record.slogan }}" id="slogan">
		</div>
	</div>
	<div class="form-group">
		<label for="summary" class="col-sm-2 control-label">{{ Lang::get('organization.summary') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="summary" type="text" value="@{{ record.summary }}" id="summary">
		</div>
	</div>
	<div class="form-group">
		<label for="description" class="col-sm-2 control-label">{{ Lang::get('organization.description') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="description" type="text" value="@{{ record.description }}" id="description">
		</div>
	</div>
	<div class="form-group">
		<label for="logo_image_uri" class="col-sm-2 control-label">{{ Lang::get('organization.logo_image_uri') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="logo_image_uri" type="text" value="@{{ record.logo_image_uri }}" id="logo_image_uri">
		</div>
	</div>
	<div class="form-group">
		<label for="cover_image_uri" class="col-sm-2 control-label">{{ Lang::get('organization.cover_image_uri') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="cover_image_uri" type="text" value="@{{ record.cover_image_uri }}" id="cover_image_uri">
		</div>
	</div>
	<div class="form-group">
		<label for="found_date" class="col-sm-2 control-label">{{ Lang::get('organization.found_date') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="found_date" type="text" value="@{{ record.found_date }}" id="found_date">
		</div>
	</div>
	<div class="form-group">
		<label for="status" class="col-sm-2 control-label">{{ Lang::get('organization.status') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="status" type="text" value="@{{ record.status }}" id="status">
		</div>
	</div>
	<div class="form-group">
		<label for="num_members" class="col-sm-2 control-label">{{ Lang::get('organization.num_members') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="num_members" type="text" value="@{{ record.num_members }}" id="num_members">
		</div>
	</div>
	<div class="form-group">
		<label for="num_comments" class="col-sm-2 control-label">{{ Lang::get('organization.num_comments') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="num_comments" type="text" value="@{{ record.num_comments }}" id="num_comments">
		</div>
	</div>
	<div class="form-group">
		<label for="num_cheers" class="col-sm-2 control-label">{{ Lang::get('organization.num_cheers') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="num_cheers" type="text" value="@{{ record.num_cheers }}" id="num_cheers">
		</div>
	</div>
	<div class="form-group">
		<label for="params_text" class="col-sm-2 control-label">{{ Lang::get('organization.params_text') }}</label>
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
