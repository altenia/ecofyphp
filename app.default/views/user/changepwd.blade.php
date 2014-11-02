<?php use Altenia\Ecofy\Module\Security\AccessControl; ?>
<!-- app/views/users/edit.blade.php -->

@section('content')
<div class="container" ng-controller="UserChangePwdFormCtrl">

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}
<!--include ('_partial/errors')-->

{{ Form::model($record, array('url' => 'user/changepwd', 'method' => 'PUT', 'class' => 'form-horizontal')) }}
	
	<div class="form-group">
		{{ Form::label('id', Lang::get('user.id'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ $record->id }}
		</div>
	</div>

	<div class="form-group">
		{{ Form::label('password', Lang::get('user.password'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::password('password', array('class' => 'form-control')) }}
		</div>
	</div>

	<div class="form-group">
		{{ Form::label('password_confirm', Lang::get('user.password_confirm'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::password('password_confirm', array('class' => 'form-control')) }}
		</div>
	</div>


	<div class="form-group">
    	<div class="col-sm-offset-2 col-sm-10">
    		<button name="_submit" type="submit" value="save_return" class="btn btn-primary">{{ Lang::get('common.save_return') }}</button>
    		<a href="{{ URL::to(route('users.show', array($record->sid))) }}" class="btn btn-primary">{{ Lang::get('common.cancel') }}</a>
		</div>
	</div>

{{ Form::close() }}


<script>

var myapp = angular.module('myapp', []);

myapp.controller('UserChangePwdFormCtrl', function($scope, $http) {

	// Angular's on document ready 
	angular.element(document).ready(function () {
        // Initilize Bootstrap tab  
    });

});

</script>


@show