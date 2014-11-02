<?php use Altenia\Ecofy\Module\Security\AccessControl; ?>
<!-- app/views/users/edit.blade.php -->

@section('content')
<div class="container" ng-controller="UserFormCtrl">

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}
<!--include ('_partial/errors')-->

{{ Form::model($record, array('route' => array('users.update', $record->sid), 'method' => 'PUT', 'class' => 'form-horizontal')) }}
	{{ Form::hidden('organization_sid', null, array('id' => 'organization_sid')) }}
	
	<div class="form-group">
		{{ Form::label('org_name', Lang::get('user.organization'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
			<div class="input-group">
		    {{ Form::text('org_name', null, array('class' => 'form-control', 'readonly'=>'readonly')) }}
			<span class="input-group-btn">
				<button class="btn btn-default" type="button" data-toggle="modal" data-target=".org-selector-dialog">Search</button>
			</span>
		</div>
		</div>
	</div>

	<div class="form-group">
		{{ Form::label('id', Lang::get('user.id'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('id', null, array('class' => 'form-control')) }}
		</div>
	</div>

	<!--
	<div class="form-group">
		{{ Form::label('password', Lang::get('user.password'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('password', null, array('class' => 'form-control')) }}
		</div>
	</div>
	-->

	<div class="form-group">
		{{ Form::label('given_name', Lang::get('user.given_name'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('given_name', null, array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('middle_name', Lang::get('user.middle_name'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('middle_name', null, array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('family_name', Lang::get('user.family_name'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('family_name', null, array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('name_nl', Lang::get('user.name_nl'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('name_nl', null, array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('name', Lang::get('user.name'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('name', null, array('class' => 'form-control')) }}
		</div>
	</div>
	<!--
	<div class="form-group">
		{{ Form::label('dob', Lang::get('users.dob'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('dob', null, array('class' => 'form-control')) }}
		</div>
	</div>
	-->
	<div class="form-group">
		{{ Form::label('phone', Lang::get('user.phone'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('phone', null, array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('email', Lang::get('user.email'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('email', null, array('class' => 'form-control')) }}
		</div>
	</div>

	<div class="form-group">
		{{ Form::label('security_question', Lang::get('user.security_question'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('security_question', null, array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('security_answer', Lang::get('user.security_answer'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('security_answer', null, array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('default_lang_cd', Lang::get('user.default_lang_cd'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('default_lang_cd', null, array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('timezone', Lang::get('user.timezone'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('timezone', null, array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('params_text', 'Params_text', array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('params_text', null, array('class' => 'form-control')) }}
		</div>
	</div>

	@if ($accessControl->check(AccessControl::FLAG_ADMIN, 'svc:user'))
	<div class="form-group">
		{{ Form::label('permalink', Lang::get('user.permalink'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('permalink', null, array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('activation_code', Lang::get('user.activation_code'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('activation_code', null, array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('type', Lang::get('user.type'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::select('type', $auxdata['opt_types'], null, array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('role', Lang::get('user.role'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::select('role_sid', $auxdata['opt_roles'], null, array('class' => 'form-control')) }}
		</div>
	</div>
	@endif

	<div class="form-group">
    	<div class="col-sm-offset-2 col-sm-10">
	    	<button name="_submit" type="submit" value="save" class="btn btn-primary">{{ Lang::get('common.save') }}</button>
    		<button name="_submit" type="submit" value="save_return" class="btn btn-primary">{{ Lang::get('common.save_return') }}</button>
    		<a href="{{ URL::to(route('users.show', array($record->sid))) }}" class="btn btn-primary">{{ Lang::get('common.return') }}</a>
		</div>
	</div>

{{ Form::close() }}


<!-- Organization select Dialog box -->
<div class="modal fade org-selector-dialog" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Select Organization</h4>
      </div>
      <div class="modal-body">
      	<!-- form -->
      	<div class="col-xs-8 col-xs-offset-2">
			<div class="input-group">
	            <input type="text" class="form-control" name="org_search_text" ng-model="org_search_text" placeholder="Search Company...">
	            <span class="input-group-btn">
	                <button class="btn btn-default" type="button" ng-click="orgSearch()"><span class="glyphicon glyphicon-search"></span></button>
	            </span>
	        </div>
		</div>
		<!-- form -->

      	<table class="table table-striped">
      		<thead>
				<td>{{ Lang::get('common.updated_dt') }}</td>
				<td>{{ Lang::get('organization.name') }}</td>
				<td>{{ Lang::get('organization.url') }}</td>
				<td>{{ Lang::get('organization.country_cd') }}</td>
				<td>{{ Lang::get('organization.province_cd') }}</td>
      		</thead>
      		<tbody ng-repeat="organization in org_search_result">
      			<td>@{{ organization.updated_dt }}</td>
      			<td><a ng-click="orgSelect($index)"> @{{ organization.name }}</a></td>
      			<td>@{{ organization.url }}</td>
      			<td>@{{ organization.country_cd }}</td>
      			<td>@{{ organization.province_cd }}</td>
      		</tbody>
      		<tfoot>
      		</tfoot>
      	</table>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Select</button>
      </div>
    </div>
  </div>
</div>


<script>

var myapp = angular.module('myapp', []);

myapp.controller('UserFormCtrl', function($scope, $http) {

	$scope.org_search_text = '';
	$scope.org_search_result = [];

	// Angular's on document ready 
	angular.element(document).ready(function () {
        // Initilize Bootstrap tab  
    });

	$scope.orgSearch = function()
	{
		var organizationsUrl = '{{ URL::to(route('api.organizations.index')) }}';

		$http({method: 'GET', url: organizationsUrl}).
			success(function(data, status, headers, config) {
		      $scope.org_search_result = data;
		    }).
		    error(function(data, status, headers, config) {
		      alert ("Error retrieving child document");
		    });
	}

	$scope.orgSelect = function(index)
	{
		$('#org_sid').val($scope.org_search_result[index].sid);
		$('#org_name').val($scope.org_search_result[index].name);
		$('.org-selector-dialog').modal('hide');
	}

});

</script>


@show