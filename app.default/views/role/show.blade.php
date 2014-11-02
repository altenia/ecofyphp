
<!-- app/views/role/show.blade.php -->

@section('content')
<div class="container" ng-controller="AccessControlShowCtrl">

<!-- @todo: the field to be displayed as title -->


<!-- Nav tabs -->
<ul class="nav nav-tabs" id="page_tab">
  <li class="details"><a href="#home" data-toggle="tab">Details</a></li>
  <li><a href="#access_control" data-toggle="tab">Access Control</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane active" id="home">

<dl class="dl-horizontal">
    <dt>{{ Lang::get('common.domain_sid') }}</dt>
    <dd>{{ $record->domain_sid }}</dd>
    <dt>{{ Lang::get('common.domain_id') }}</dt>
    <dd>{{ $record->domain_id }}</dd>
    <dt>{{ Lang::get('common.creator_sid') }}</dt>
    <dd>{{ $record->creator_sid }}</dd>
    <dt>{{ Lang::get('common.created_dt') }}</dt>
    <dd>{{ $record->created_dt }}</dd>
    <dt>{{ Lang::get('common.updated_by') }}</dt>
    <dd>{{ $record->updated_by }}</dd>
    <dt>{{ Lang::get('common.updated_dt') }}</dt>
    <dd>{{ $record->updated_dt }}</dd>
    <dt>{{ Lang::get('common.update_counter') }}</dt>
    <dd>{{ $record->update_counter }}</dd>
    <dt>{{ Lang::get('common.uuid') }}</dt>
    <dd>{{ $record->uuid }}</dd>
    <dt>{{ Lang::get('common.lang') }}</dt>
    <dd>{{ $record->lang }}</dd>
    <dt>{{ Lang::get('role.subject_type') }}</dt>
    <dd>{{ $record->subject_type }}</dd>
    <dt>{{ Lang::get('role.name') }}</dt>
    <dd>{{ $record->name }}</dd>
    <dt>{{ Lang::get('role.params_text') }}</dt>
    <dd>{{ $record->params_text }}</dd>
</dl>

  </div>
  <div class="tab-pane" id="access_control">

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>{{ Lang::get('common.created_dt') }}</td>
            <td>{{ Lang::get('access_control.service') }} : {{ Lang::get('access_control.permission') }}</td>
            <td>{{ Lang::get('access_control.policy') }}</td>
            <td class="actions_col">{{ Lang::get('common.actions') }}</td>
        </tr>
    </thead>
    <tbody>
        <tr ng-repeat="record in list">
            <td>@{{ record.created_dt }}</td>
            <td>@{{ record.service }} : @{{ record.permissions }}</td>
            <td>@{{ record.policy }}</td>

            <!-- action buttons -->
            <td>
                <button title="Delete" type="button" ng-click="doDelete(record.sid)" class="btn btn-small btn-danger">
                  <span class="glyphicon glyphicon-trash"></span>
                </button>
            </td>
        </tr>
        <tr>
            <td><input type="hidden" name="role_sid" value=""></td>
            <td>
                <div class="form-group">
                <input type="text" name="service" ng-model="newEntry.service" class="form-control" placeholder="Service" >
                <a href="#" id="permissions" data-type="checklist" data-pk="1" data-title="Set permission">permissions</a>
                </div >
            </td>
            <td>
                <div class="col-sm-9"><input type="text" name="resource" ng-model="newEntry.resource" value="" class="form-control" placeholder="Resource" ></div>
                <div class="col-sm-3"><a href="#" id="resource_permissions" data-type="checklist" data-pk="1" data-title="Set resource permissions">permissions</a></div>
            </td>

            <!-- action buttons -->
            <td>
                <button title="Add" type="button" ng-click="doAdd()" class="btn btn-small btn-info">
                  <span class="glyphicon glyphicon-plus"></span>
                </button>
            </td>
        </tr>
    </tbody>
</table>

  </div>
</div>

</div> <!-- container -->


<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
<script>

var myapp = angular.module('myapp', []);

myapp.controller('AccessControlShowCtrl', function($scope, $http) {

    var opt_permissions = [
                @foreach($auxdata['opt_permissions'] as $opt_key => $opt_val)
                {value: {{ $opt_key}}, text:"{{$opt_val}}"},
                @endforeach
            ];

    $scope.list = [];

    var _role_sid = "{{ $record->sid }}";

    $scope.newEntry = {  };

    loadAccessControls();

    function loadAccessControls() {
        $http({method: 'GET', url: '/api/access_controls?role_sid-eq=' + _role_sid}).
            success(function(data, status, headers, config) {
                $scope.list = data;
            }).
            error(function(data, status, headers, config) {
            });
    }

	// Angular's on document ready 
	angular.element(document).ready(function () {
        // Initilize Bootstrap tab 
    	$('.page-header').append(' <a title="Edit" href="{{ URL::to(route('roles.edit', array($record->sid))) }}"><small><span class="glyphicon glyphicon-pencil"></span></small></a>')

        $('#page_tab a:first').tab('show')

        $('#permissions').editable({
            placeholder: "Permissions",
            source: opt_permissions,
            success: function(response, newValue) {
                $scope.newEntry['permissions'] = newValue;
            }
        });

        $('#resource_permissions').editable({
            //mode: 'inline',
            placeholder: "Permissions",
            source: opt_permissions,
            success: function(response, newValue) {
                $scope.newEntry['resource_permissions'] = newValue;
            }
        });
    });

    /**
     * Turn array into bitflag
     */
    function arrayToBitFlag(intArray)
    {
        var bitFlags = 0;
        if (intArray) {
            for (var i=0; i < intArray.length; i++) {
                bitFlags |= intArray[i];
            }
        }
        return bitFlags;
    }

    $scope.doAdd = function()
    {
        var permissions = arrayToBitFlag($scope.newEntry.permissions);
        var resource_permissions = arrayToBitFlag($scope.newEntry.resource_permissions);

        var postData = {
            role_sid: _role_sid,
            service: $scope.newEntry.service,
            permissions: permissions,
            resource: $scope.newEntry.resource,
            resource_permissions: resource_permissions
            };
        $http({method: 'POST', url: '/api/access_controls', data: postData}).
        success(function(data, status, headers, config) {
            loadAccessControls();
        }).
        error(function(data, status, headers, config) {
            alert(JSON.stringify(data));
        });
    }

    $scope.doUpdate = function(index)
    {
    }

    $scope.doDelete = function(sid)
    {
        $http({method: 'DELETE', url: '/api/access_controls/'+sid}).
        success(function(data, status, headers, config) {
            loadAccessControls();
        }).
        error(function(data, status, headers, config) {
            alert(JSON.stringify(data));
        });
    }


});

</script>

@show
