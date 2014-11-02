<?php use Altenia\Ecofy\Module\Security\AccessControl; ?>
<!-- app/views/users/index.blade.php -->
@section('content')
<div class="container" ng-controller="UserIndexCtrl">

<!-- will be used to show any messages -->
@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<!-- Filter BEGIN -->
<div class="panel panel-info" id="df_filter_pane">
	<div class="panel-body">
		<form class="form-inline" role="form" method="GET">
		  <div class="form-group">
		    <label class="sr-only" for="company">{{ Lang::get('user.organization_name') }}</label>
		    <input type="text" class="form-control" id="filter_org" placeholder="Organization" ng-model="recordTable.filter_params['org_name-re']">
		  </div>
		  <div class="form-group">
		    <label class="sr-only" for="name">{{ Lang::get('user.name') }}</label>
		    <input type="text" class="form-control" id="filter_name" placeholder="User Name" ng-model="recordTable.filter_params['user_name-re']">
		  </div>
		  <div class="form-group">
		    <label class="sr-only" for="name">{{ Lang::get('user.type') }}</label>
		    <input type="text" class="form-control" id="filter_type" placeholder="User Type" ng-model="recordTable.filter_params['user_type-re']">
		  </div>
		  <button type="button" class="btn btn-default" ng-click="recordTable.resetFilter()">Reset</button>
		  <a href="#?_page=0@{{recordTable.filterQueryString()}}" type="submit" class="btn btn-info" ng-click="recordTable.doFilter()">Go</a>

		  <div class="form-group pull-right">
		  	<label for="name">{{ Lang::get('common.page_size') }}</label>
		    <select class="form-control" id="page_size" ng-model="recordTable.filter_params._limit" ng-options="pagesize_opt for pagesize_opt in recordTable.pagesize_opts"> </select>
		  </div>
		</form>
	</div>
</div>
<!-- Filter END -->

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<td>{{ Lang::get('user.org_name') }}</td>
			<td>{{ Lang::get('common.created_dt') }}</td>
			<td>{{ Lang::get('user.id') }}</td>
			<td>{{ Lang::get('user.name') }}</td>
			<td>{{ Lang::get('user.name_nl') }}</td>
			<td>{{ Lang::get('user.email') }}</td>
			<td>{{ Lang::get('user.status') }}</td>

			@if ($accessControl->check(AccessControl::FLAG_ADMIN, 'svc:user'))
			<td>{{ Lang::get('user.expiry_dt') }}</td>
			<td>{{ Lang::get('user.type') }}</td>
			@endif
			<td>{{ Lang::get('user.role') }}</td>
			<td class="actions_col">{{ Lang::get('common.actions') }}</td>
		</tr>
	</thead>
	<tbody>
		<tr ng-repeat="record in recordTable.result">
			<td>@{{ record.org_name }}</td>
			<td title="Updated: @{{ record.updated_dt }}">@{{ record.created_dt | date : date:'yyyy-MM-dd'}}</td>
			<td><a href="users/@{{ record.sid }}">@{{ record.id }}</a></td>
			<td>@{{ record.give_name }} @{{ record.middle_name }} @{{ record.family_name }}</td>
			<td>@{{ record.name_nl }}</td>
			<td>@{{ record.email }}</td>
			<td>@{{ record.status }}</td>
			@if ($accessControl->check(AccessControl::FLAG_ADMIN, 'svc:user'))
			<td>@{{ record.expiry_dt }}</td>
			<td>@{{ record.type }}</td>
			@endif
			<td>@{{ record.role_name }}</td>

			<!-- we will also add show, edit, and delete buttons -->
			<td>
				@if ($accessControl->check(AccessControl::FLAG_UPDATE, 'svc:user'))
				<a class="btn btn-small btn-info" href="@{{ routeUrl(record, '/edit') }}"><span class="glyphicon glyphicon-pencil"></span></a>
				@endif

				@if ($accessControl->check(AccessControl::FLAG_DELETE, 'svc:user'))
				<button title="Delete" type="button" ng-click="doDelete(record)" class="btn btn-small btn-danger">
				  <span class="glyphicon glyphicon-trash"></span>
				</button>
				@endif
			</td>
		</tr>
	</tbody>
</table>

@include('_partials.pagination')

</div> <!-- container -->

{{ HTML::script('js/ecofy_utils.js') }}
{{ HTML::script('js/ecofy_recordtable.js') }}
<script>

var myapp = angular.module('myapp', []);

myapp.controller('UserIndexCtrl', function($scope, $location, $http, $rootScope) 
{
	$scope.recordTable = new RecordTable(
		updateListener, '{{ URL::to(route('api.users.index')) }}'
		);

	// Required for navigating using back browser's button
	$rootScope.$on('$locationChangeSuccess', function(event) {
		var qparams = $location.search();
		$scope.recordTable.setFilter(qparams);
	});


	// Angular's on document ready 
	angular.element(document).ready(function () {
        // Initilize Bootstrap tab 
    	$('.page-header').append(' <a class="btn btn-small btn-info" href="{{ URL::to(route('users.create')) }}"><span class="glyphicon glyphicon-plus"></span> New</a>')

    	$scope.recordTable.init( $('#df_filter_pane') );
    });


	/**
	 * Returns the REST URL for get
	 */
    $scope.routeUrl = function(record, suffix)
    {
    	if (!suffix) suffix = '';
    	return 'users/' + record.sid + suffix;
    }

    /** 
     * Callback function when result is updated 
     */
    function updateListener()
    {
    	$scope.$apply();
    }

});

</script>
@show