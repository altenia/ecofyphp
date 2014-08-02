
<!-- app/views/user/edit.blade.php -->

@section('content')
<div class="container">

<div ng-controller="DocumentTypeFormCtrl">
<!-- @todo: properly set the field name to be displayed as title -->
<h1>Edit @{{ record.name }}</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

<!-- @todo: Make sure that the primaryKey column name is sid -->
{{ Form::model($record, array('route' => array('users.update', $record->sid), 'method' => 'PUT', 'class' => 'form-horizontal')) }}

<!--
    @todo: Remove non-editable fields.
           Add client-side validation.
-->
	<div class="form-group">
		<label for="uuid" class="col-sm-2 control-label">{{ Lang::get('user.uuid') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="uuid" type="text" value="@{{ record.uuid }}" id="uuid">
		</div>
	</div>
	<div class="form-group">
		<label for="domain_sid" class="col-sm-2 control-label">{{ Lang::get('user.domain_sid') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="domain_sid" type="text" value="@{{ record.domain_sid }}" id="domain_sid">
		</div>
	</div>
	<div class="form-group">
		<label for="domain_id" class="col-sm-2 control-label">{{ Lang::get('user.domain_id') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="domain_id" type="text" value="@{{ record.domain_id }}" id="domain_id">
		</div>
	</div>
	<div class="form-group">
		<label for="created_by" class="col-sm-2 control-label">{{ Lang::get('user.created_by') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="created_by" type="text" value="@{{ record.created_by }}" id="created_by">
		</div>
	</div>
	<div class="form-group">
		<label for="created_dt" class="col-sm-2 control-label">{{ Lang::get('user.created_dt') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="created_dt" type="text" value="@{{ record.created_dt }}" id="created_dt">
		</div>
	</div>
	<div class="form-group">
		<label for="updated_by" class="col-sm-2 control-label">{{ Lang::get('user.updated_by') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="updated_by" type="text" value="@{{ record.updated_by }}" id="updated_by">
		</div>
	</div>
	<div class="form-group">
		<label for="updated_dt" class="col-sm-2 control-label">{{ Lang::get('user.updated_dt') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="updated_dt" type="text" value="@{{ record.updated_dt }}" id="updated_dt">
		</div>
	</div>
	<div class="form-group">
		<label for="update_counter" class="col-sm-2 control-label">{{ Lang::get('user.update_counter') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="update_counter" type="text" value="@{{ record.update_counter }}" id="update_counter">
		</div>
	</div>
	<div class="form-group">
		<label for="lang" class="col-sm-2 control-label">{{ Lang::get('user.lang') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="lang" type="text" value="@{{ record.lang }}" id="lang">
		</div>
	</div>
	<div class="form-group">
		<label for="user_sid" class="col-sm-2 control-label">{{ Lang::get('user.user_sid') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="user_sid" type="text" value="@{{ record.user_sid }}" id="user_sid">
		</div>
	</div>
	<div class="form-group">
		<label for="first_name" class="col-sm-2 control-label">{{ Lang::get('user.first_name') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="first_name" type="text" value="@{{ record.first_name }}" id="first_name">
		</div>
	</div>
	<div class="form-group">
		<label for="middle_name" class="col-sm-2 control-label">{{ Lang::get('user.middle_name') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="middle_name" type="text" value="@{{ record.middle_name }}" id="middle_name">
		</div>
	</div>
	<div class="form-group">
		<label for="last_name" class="col-sm-2 control-label">{{ Lang::get('user.last_name') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="last_name" type="text" value="@{{ record.last_name }}" id="last_name">
		</div>
	</div>
	<div class="form-group">
		<label for="lc_name" class="col-sm-2 control-label">{{ Lang::get('user.lc_name') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="lc_name" type="text" value="@{{ record.lc_name }}" id="lc_name">
		</div>
	</div>
	<div class="form-group">
		<label for="alt_name" class="col-sm-2 control-label">{{ Lang::get('user.alt_name') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="alt_name" type="text" value="@{{ record.alt_name }}" id="alt_name">
		</div>
	</div>
	<div class="form-group">
		<label for="primary_lang" class="col-sm-2 control-label">{{ Lang::get('user.primary_lang') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="primary_lang" type="text" value="@{{ record.primary_lang }}" id="primary_lang">
		</div>
	</div>
	<div class="form-group">
		<label for="nationality_cd" class="col-sm-2 control-label">{{ Lang::get('user.nationality_cd') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="nationality_cd" type="text" value="@{{ record.nationality_cd }}" id="nationality_cd">
		</div>
	</div>
	<div class="form-group">
		<label for="hometown" class="col-sm-2 control-label">{{ Lang::get('user.hometown') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="hometown" type="text" value="@{{ record.hometown }}" id="hometown">
		</div>
	</div>
	<div class="form-group">
		<label for="gender" class="col-sm-2 control-label">{{ Lang::get('user.gender') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="gender" type="text" value="@{{ record.gender }}" id="gender">
		</div>
	</div>
	<div class="form-group">
		<label for="dob" class="col-sm-2 control-label">{{ Lang::get('user.dob') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="dob" type="text" value="@{{ record.dob }}" id="dob">
		</div>
	</div>
	<div class="form-group">
		<label for="education_level" class="col-sm-2 control-label">{{ Lang::get('user.education_level') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="education_level" type="text" value="@{{ record.education_level }}" id="education_level">
		</div>
	</div>
	<div class="form-group">
		<label for="highlight" class="col-sm-2 control-label">{{ Lang::get('user.highlight') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="highlight" type="text" value="@{{ record.highlight }}" id="highlight">
		</div>
	</div>
	<div class="form-group">
		<label for="philosophy" class="col-sm-2 control-label">{{ Lang::get('user.philosophy') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="philosophy" type="text" value="@{{ record.philosophy }}" id="philosophy">
		</div>
	</div>
	<div class="form-group">
		<label for="goals" class="col-sm-2 control-label">{{ Lang::get('user.goals') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="goals" type="text" value="@{{ record.goals }}" id="goals">
		</div>
	</div>
	<div class="form-group">
		<label for="personality_type" class="col-sm-2 control-label">{{ Lang::get('user.personality_type') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="personality_type" type="text" value="@{{ record.personality_type }}" id="personality_type">
		</div>
	</div>
	<div class="form-group">
		<label for="location" class="col-sm-2 control-label">{{ Lang::get('user.location') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="location" type="text" value="@{{ record.location }}" id="location">
		</div>
	</div>
	<div class="form-group">
		<label for="country_cd" class="col-sm-2 control-label">{{ Lang::get('user.country_cd') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="country_cd" type="text" value="@{{ record.country_cd }}" id="country_cd">
		</div>
	</div>
	<div class="form-group">
		<label for="province_cd" class="col-sm-2 control-label">{{ Lang::get('user.province_cd') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="province_cd" type="text" value="@{{ record.province_cd }}" id="province_cd">
		</div>
	</div>
	<div class="form-group">
		<label for="district" class="col-sm-2 control-label">{{ Lang::get('user.district') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="district" type="text" value="@{{ record.district }}" id="district">
		</div>
	</div>
	<div class="form-group">
		<label for="address" class="col-sm-2 control-label">{{ Lang::get('user.address') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="address" type="text" value="@{{ record.address }}" id="address">
		</div>
	</div>
	<div class="form-group">
		<label for="postal_code" class="col-sm-2 control-label">{{ Lang::get('user.postal_code') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="postal_code" type="text" value="@{{ record.postal_code }}" id="postal_code">
		</div>
	</div>
	<div class="form-group">
		<label for="privacy_level" class="col-sm-2 control-label">{{ Lang::get('user.privacy_level') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="privacy_level" type="text" value="@{{ record.privacy_level }}" id="privacy_level">
		</div>
	</div>
	<div class="form-group">
		<label for="activity_index" class="col-sm-2 control-label">{{ Lang::get('user.activity_index') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="activity_index" type="text" value="@{{ record.activity_index }}" id="activity_index">
		</div>
	</div>
	<div class="form-group">
		<label for="params_text" class="col-sm-2 control-label">{{ Lang::get('user.params_text') }}</label>
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
