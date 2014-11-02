
<!-- app/views/organization/index.blade.php -->

@section('content')
<div class="container" ng-controller="OrganizationIndexCtrl">

<!-- will be used to show any messages -->
@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<!-- Filter BEGIN -->
<div class="panel panel-info" id="df_filter_pane">
	<div class="panel-body">
		<form class="form-inline" role="form" method="GET">
		  <div class="form-group">
		    <label class="sr-only" for="company">{{ Lang::get('organization.category') }}</label>
		    <input type="text" class="form-control" id="filter_category" placeholder="Category" ng-model="recordTable.filter_params['category-re']">
		  </div>
		  <div class="form-group">
		    <label class="sr-only" for="name">{{ Lang::get('organization.name') }}</label>
		    <input type="text" class="form-control" id="filter_name" placeholder="Name" ng-model="recordTable.filter_params['name-re']">
		  </div>

		  <button type="button" class="btn btn-default" ng-click="recordTable.resetFilter()">{{ Lang::get('common.reset') }}</button>
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
			<td>{{ Lang::get('common.created_dt') }}</td>
			<td>{{ Lang::get('common.updated_dt') }}</td>
			<td>{{ Lang::get('organization.name') }}</td>
			<td>{{ Lang::get('organization.category') }}</td>
			<td>{{ Lang::get('organization.url') }}</td>
			<td>{{ Lang::get('organization.country_cd') }}</td>
			<td>{{ Lang::get('organization.province_cd') }}</td>
			<td>{{ Lang::get('organization.role') }}</td>
            <td class="actions_col">{{ Lang::get('common.actions') }}</td>
		</tr>
	</thead>
	<tbody>
		<tr ng-repeat="record in recordTable.result">
			<td title="by @{{ record.creator_sid }}">@{{ record.created_dt }}</td>
			<td title="count: @{{ record.updated_counter }}">@{{ record.updated_dt }}</td>
			<td><a href="@{{ routeUrl(record) }}">@{{ record.name }}</a></td>
			<td>@{{ record.category }}</td>
			<td>@{{ record.url }}</td>
			<td>@{{ record.country_cd }}</td>
			<td>@{{ record.province_cd }}</td>
			<td>@{{ record.role_name }}</td>

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

myapp.controller('OrganizationIndexCtrl', function($scope, $location, $http, $rootScope) 
{
	$scope.recordTable = new RecordTable(
		updateListener, '{{ URL::to(route('api.organizations.index')) }}'
		);

	// Required for navigating using back browser's button
	$rootScope.$on('$locationChangeSuccess', function(event) {
		var qparams = $location.search();
		$scope.recordTable.setFilter(qparams);
	});


	// Angular's on document ready 
	angular.element(document).ready(function () {
        // Initilize Bootstrap tab 
    	$('.page-header').append(' <a class="btn btn-small btn-info" href="{{ URL::to(route('organizations.create')) }}"><span class="glyphicon glyphicon-plus"></span> New</a>')

    	$scope.recordTable.init( $('#df_filter_pane') );
    });


	/**
	 * Returns the REST URL for get
	 */
    $scope.routeUrl = function(record, suffix)
    {
    	if (!suffix) suffix = '';
    	return 'organizations/' + record.sid + suffix;
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
