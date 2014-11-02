<?php use Altenia\Ecofy\Module\Security\AccessControl; ?>
<!-- app/views/persons/index.blade.php -->
@section('content')
<div class="container" ng-controller="PersonIndexCtrl">

<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<!-- Filter BEGIN -->
<div class="panel panel-info" id="df_filter_pane">
    <div class="panel-body">
        <form class="form-inline" role="form" method="GET">
          <div class="form-group">
            <label class="sr-only" for="name">{{ Lang::get('person.name_nl') }}</label>
            <input type="text" style="width:100px" class="form-control" id="filter_name_nl" placeholder="{{ Lang::get('person.name_nl') }}" ng-model="recordTable.filter_params['persons:name_nl-like']">
          </div>
          <div class="form-group">
            <label class="sr-only" for="name">{{ Lang::get('person.name') }}</label>
            <input type="text" class="form-control" id="filter_name" placeholder="Name" ng-model="recordTable.filter_params['persons:name-like']">
          </div>
          <div class="form-group">
            <label class="sr-only" for="affiliation">{{ Lang::get('person.affiliation') }}</label>
            <input type="text" style="width:100px" class="form-control" id="filter_affiliation" placeholder="{{ Lang::get('person.affiliation') }}" ng-model="recordTable.filter_params['persons:affiliation-like']">
          </div>
          @if ($accessControl->check(AccessControl::FLAG_ADMIN, 'svc:person'))
          <div class="form-group">
            <label class="sr-only" for="status">{{ Lang::get('person.status') }}</label>
            {{ Form::select('status', $auxdata['status'], null, array('class' => 'form-control', 'placeholder' => Lang::get('person.status'), 'ng-model' => "recordTable.filter_params['persons:status-eq']" )) }}
          </div>
          @endif
          <div style="display:inline">
              <button type="button" class="btn btn-default" style="background-color: #f7f7f7" ng-click="recordTable.resetFilter()">Reset</button>
              <button type="submit" href="#?_page=0@{{recordTable.filterQueryString()}}" type="submit" class="btn btn-info" ng-click="doFilter()">Go</button>
              @if ($accessControl->check(AccessControl::FLAG_ADMIN, 'svc:person'))
              <a href="?_format=csv&_page=0@{{filterToQueryString()}}" class="btn btn-default">CSV</a>
              @endif
          </div>
          <div class="form-group pull-right">
            <label for="name">{{ Lang::get('common.page_size') }}</label>
            <select class="form-control" id="page_size" ng-model="recordTable.filter_params._limit" ng-options="pagesize_opt for pagesize_opt in recordTable.pagesize_opts"> </select>
          </div>
        </form>
    </div>
</div>
<!-- Filter END -->

<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <!-- <td>{{ Lang::get('common.created_dt') }}</td> -->
            <td>{{ Lang::get('person.name_nl') }}</td>
            <td>{{ Lang::get('person.name') }}</td>
            <td>{{ Lang::get('person.address') }}</td>
            <td>{{ Lang::get('person.email') }}</td>
            <td>{{ Lang::get('person.telephone') }}</td>
            <td>{{ Lang::get('person.affiliation') }}</td>
            @if ($accessControl->check(AccessControl::FLAG_ADMIN, 'svc:person'))
            <td>{{ Lang::get('person.status') }}</td>
            @endif
            <td class="actions_col">{{ Lang::get('common.actions') }}</td>
        </tr>
    </thead>
    <tbody>
        <tr ng-repeat="record in recordTable.result">
            <!-- <td title="Updated: @{{ record.updated_dt }}">@{{ record.created_dt | date:'yyyy-MM-dd'}}</td> -->
            <td nowrap title="@{{ record.id }}, (hof: @{{ record.head_of_family }})">@{{ record.name_nl }} <br/ >@{{ record.alternate_name }}</td>
            <td title="user: @{{ record.user_sid }}"> <a href="@{{ routeUrl(record, '') }}">@{{ record.name }}</a></td>
            @if ($accessControl->check(AccessControl::FLAG_UPDATE, 'svc:person'))
            <td>@{{ record.address }} @{{ record.province_cd }} @{{ record.postal_code }}</td>
            <td><a href="mailto:@{{ record.email }}" target="_blank">@{{ record.email }}</a></td>
            <td><div ng-if="record.telephone" style="white-space: nowrap;"> @{{ record.telephone }} (H)</div>
                <div ng-if="record.mobile_number" style="white-space: nowrap;"> @{{ record.mobile_number }} (M)</div>
                </td>
            @else
            <td colspan="3" class="text-center"><span class="text-muted">[No permission]<span></td>
            @endif
            <td>@{{ record.affiliation }}</td>
            @if ($accessControl->check(AccessControl::FLAG_ADMIN, 'svc:person'))
            <td>@{{ record.status }}</td>
            @endif

            <!-- we will also add show, edit, and delete buttons -->
            <td>
                @if (!\Auth::check())
                <a class="btn btn-small btn-info" href="{{ URL::to('personauth/signin') }}">Sign in</a>
                @endif

                @if ($accessControl->check(AccessControl::FLAG_UPDATE, 'svc:person'))
                <a class="btn btn-small btn-info" href="@{{ routeUrl(record, '/edit') }}"><span class="glyphicon glyphicon-pencil"></span></a>
                @endif

                @if ($accessControl->check(AccessControl::FLAG_DELETE, 'svc:person'))
                <button title="Delete" type="button" ng-click="recordTable.doDelete(record)" class="btn btn-small btn-danger">
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

myapp.controller('PersonIndexCtrl', function($scope, $location, $http, $rootScope) 
{
    $scope.recordTable = new RecordTable(
        updateListener, '{{ URL::to(route('api.persons.index')) }}'
        );

    // Required for navigating using back browser's button
    $rootScope.$on('$locationChangeSuccess', function(event) {
        var qparams = $location.search();
        $scope.recordTable.setFilter(qparams);
    });


    // Angular's on document ready 
    angular.element(document).ready(function () {
        // Initilize Bootstrap tab 
        @if ($accessControl->check(AccessControl::FLAG_CREATE, 'svc:person'))
        $('.page-header').append(' <a class="btn btn-small btn-info" href="{{ URL::to(route('persons.create')) }}"><span class="glyphicon glyphicon-plus"></span> New</a>')
        @endif

        $scope.recordTable.init( $('#df_filter_pane'), '{{ Lang::get('common.filter') }}',  false );
    });

    /** 
     * filter
     */
    $scope.doFilter = function()
    {
        // @todo Fix this hack:
        // Negating the eq (equal) to ne (not equal) when the value start with ~
        // THe issue is that after the fist submit, the filter_param does not 
        // retain the selected valueß
        var statusFilter = $scope.recordTable.filter_params['persons:status-eq'];
        if (statusFilter && statusFilter.charAt(0) == '~') {
            delete $scope.recordTable.filter_params['persons:status-eq'];
            $scope.recordTable.filter_params['persons:status-ne'] = statusFilter.substring(1);
        }
        $scope.recordTable.doFilter();
    }

    $scope.filterToQueryString = function()
    {
        var queryString = '';
        var filters = $scope.recordTable.filter_params;
        for(var prop in filters) {
            if (filters.hasOwnProperty(prop) && prop !== '_page' ) {
                if (filters[prop] !== '') {
                    var name = prop;
                    var val = filters[prop];
                    if (Utils.endsWith(name, '-eq') && val.charAt(0) == '~') {
                        name = prop.substring(0, prop.length-3) + '-ne';
                        val = val.substring(1);
                    }
                    queryString += '&' + name +'=' + val;
                }
            }
        }
        return queryString;
    }

    /**
     * Returns the REST URL for get
     */
    $scope.routeUrl = function(record, suffix)
    {
        if (!suffix) suffix = '';
        return 'persons/' + record.sid + suffix;
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