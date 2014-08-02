
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
		<label for="organization_sid" class="col-sm-2 control-label">{{ Lang::get('user.organization_sid') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="organization_sid" type="text" value="@{{ record.organization_sid }}" id="organization_sid">
		</div>
	</div>
	<div class="form-group">
		<label for="role_sid" class="col-sm-2 control-label">{{ Lang::get('user.role_sid') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="role_sid" type="text" value="@{{ record.role_sid }}" id="role_sid">
		</div>
	</div>
	<div class="form-group">
		<label for="role_name" class="col-sm-2 control-label">{{ Lang::get('user.role_name') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="role_name" type="text" value="@{{ record.role_name }}" id="role_name">
		</div>
	</div>
	<div class="form-group">
		<label for="id" class="col-sm-2 control-label">{{ Lang::get('user.id') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="id" type="text" value="@{{ record.id }}" id="id">
		</div>
	</div>
	<div class="form-group">
		<label for="password" class="col-sm-2 control-label">{{ Lang::get('user.password') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="password" type="text" value="@{{ record.password }}" id="password">
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
		<label for="display_name" class="col-sm-2 control-label">{{ Lang::get('user.display_name') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="display_name" type="text" value="@{{ record.display_name }}" id="display_name">
		</div>
	</div>
	<div class="form-group">
		<label for="dob" class="col-sm-2 control-label">{{ Lang::get('user.dob') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="dob" type="text" value="@{{ record.dob }}" id="dob">
		</div>
	</div>
	<div class="form-group">
		<label for="phone" class="col-sm-2 control-label">{{ Lang::get('user.phone') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="phone" type="text" value="@{{ record.phone }}" id="phone">
		</div>
	</div>
	<div class="form-group">
		<label for="email" class="col-sm-2 control-label">{{ Lang::get('user.email') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="email" type="text" value="@{{ record.email }}" id="email">
		</div>
	</div>
	<div class="form-group">
		<label for="timezone" class="col-sm-2 control-label">{{ Lang::get('user.timezone') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="timezone" type="text" value="@{{ record.timezone }}" id="timezone">
		</div>
	</div>
	<div class="form-group">
		<label for="type" class="col-sm-2 control-label">{{ Lang::get('user.type') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="type" type="text" value="@{{ record.type }}" id="type">
		</div>
	</div>
	<div class="form-group">
		<label for="permalink" class="col-sm-2 control-label">{{ Lang::get('user.permalink') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="permalink" type="text" value="@{{ record.permalink }}" id="permalink">
		</div>
	</div>
	<div class="form-group">
		<label for="profile_image_url" class="col-sm-2 control-label">{{ Lang::get('user.profile_image_url') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="profile_image_url" type="text" value="@{{ record.profile_image_url }}" id="profile_image_url">
		</div>
	</div>
	<div class="form-group">
		<label for="activation_code" class="col-sm-2 control-label">{{ Lang::get('user.activation_code') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="activation_code" type="text" value="@{{ record.activation_code }}" id="activation_code">
		</div>
	</div>
	<div class="form-group">
		<label for="security_question" class="col-sm-2 control-label">{{ Lang::get('user.security_question') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="security_question" type="text" value="@{{ record.security_question }}" id="security_question">
		</div>
	</div>
	<div class="form-group">
		<label for="security_answer" class="col-sm-2 control-label">{{ Lang::get('user.security_answer') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="security_answer" type="text" value="@{{ record.security_answer }}" id="security_answer">
		</div>
	</div>
	<div class="form-group">
		<label for="session_timestamp" class="col-sm-2 control-label">{{ Lang::get('user.session_timestamp') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="session_timestamp" type="text" value="@{{ record.session_timestamp }}" id="session_timestamp">
		</div>
	</div>
	<div class="form-group">
		<label for="last_session_ip" class="col-sm-2 control-label">{{ Lang::get('user.last_session_ip') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="last_session_ip" type="text" value="@{{ record.last_session_ip }}" id="last_session_ip">
		</div>
	</div>
	<div class="form-group">
		<label for="last_session_dt" class="col-sm-2 control-label">{{ Lang::get('user.last_session_dt') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="last_session_dt" type="text" value="@{{ record.last_session_dt }}" id="last_session_dt">
		</div>
	</div>
	<div class="form-group">
		<label for="login_fail_counter" class="col-sm-2 control-label">{{ Lang::get('user.login_fail_counter') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="login_fail_counter" type="text" value="@{{ record.login_fail_counter }}" id="login_fail_counter">
		</div>
	</div>
	<div class="form-group">
		<label for="active" class="col-sm-2 control-label">{{ Lang::get('user.active') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="active" type="text" value="@{{ record.active }}" id="active">
		</div>
	</div>
	<div class="form-group">
		<label for="status" class="col-sm-2 control-label">{{ Lang::get('user.status') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="status" type="text" value="@{{ record.status }}" id="status">
		</div>
	</div>
	<div class="form-group">
		<label for="default_lang_cd" class="col-sm-2 control-label">{{ Lang::get('user.default_lang_cd') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="default_lang_cd" type="text" value="@{{ record.default_lang_cd }}" id="default_lang_cd">
		</div>
	</div>
	<div class="form-group">
		<label for="expiry_dt" class="col-sm-2 control-label">{{ Lang::get('user.expiry_dt') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="expiry_dt" type="text" value="@{{ record.expiry_dt }}" id="expiry_dt">
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
