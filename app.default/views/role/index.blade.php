
<!-- app/views/role/index.blade.php -->

@section('content')
<div class="container" ng-controller="RoleIndexCtrl">

<!-- will be used to show any messages -->
@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<!-- Filter BEGIN -->
<div class="panel panel-info" id="df_filter_pane">
	<div class="panel-body">
		<form class="form-inline" role="form" method="GET">
		  <div class="form-group">
		    <label class="sr-only" for="company">{{ Lang::get('role.subject_type') }}</label>
		    <input type="text" class="form-control" id="filter_subject_type" placeholder="Subject Type" ng-model="recordTable.filter_params['subject_type-re']">
		  </div>
		  <div class="form-group">
		    <label class="sr-only" for="name">{{ Lang::get('role.name') }}</label>
		    <input type="text" class="form-control" id="filter_name" placeholder="Name" ng-model="recordTable.filter_params['name-re']">
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
			<td>{{ Lang::get('common.updated_dt') }}</td>
			<td>{{ Lang::get('role.subject_type') }}</td>
			<td>{{ Lang::get('role.name') }}</td>
            <td class="actions_col">{{ Lang::get('common.actions') }}</td>
		</tr>
	</thead>
	<tbody>
		<tr ng-repeat="record in recordTable.result">
			<td>@{{ record.updated_dt }}</td>
			<td>@{{ record.subject_type }}</td>
			<td><a href="@{{ routeUrl(record) }}">@{{ record.name }}</a></td>

			<!-- action buttons -->
			<td>
				<a class="btn btn-small btn-info" href="@{{ routeUrl(record, '/edit') }}"><span class="glyphicon glyphicon-pencil"></span></a>

				<button title="Delete" type="button" ng-click="recordTable.doDelete(record.sid)" class="btn btn-small btn-danger">
				  <span class="glyphicon glyphicon-trash"></span>
				</button>
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

myapp.controller('RoleIndexCtrl', function($scope, $location, $http, $rootScope) 
{
	$scope.recordTable = new RecordTable(
		updateListener, '{{ URL::to(route('api.roles.index')) }}'
		);

	// Required for navigating using back browser's button
	$rootScope.$on('$locationChangeSuccess', function(event) {
		var qparams = $location.search();
		$scope.recordTable.setFilter(qparams);
	});


	// Angular's on document ready 
	angular.element(document).ready(function () {
        // Initilize Bootstrap tab 
    	$('.page-header').append(' <a class="btn btn-small btn-info" href="{{ URL::to(route('roles.create')) }}"><span class="glyphicon glyphicon-plus"></span> New</a>')

    	$scope.recordTable.init( $('#df_filter_pane') );
    });


	/**
	 * Returns the REST URL for get
	 */
    $scope.routeUrl = function(record, suffix)
    {
    	if (!suffix) suffix = '';
    	return 'roles/' + record.sid + suffix;
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
