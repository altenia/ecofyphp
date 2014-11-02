<!-- app/views/persons/edit.blade.php -->

@section('content')
<div class="container" ng-controller="PersonFormCtrl">

<h1>Create New</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

<!-- Make sure that the primaryKey column name is sid -->
{{ Form::open(array('url' => 'persons', 'class' => 'form-horizontal')) }}
	{{ Form::hidden('name', null, array('id' => 'name')) }}
	<?php 

		$hof = array_key_exists('hof', $auxdata) ? $auxdata['hof']: null;
		if ($hof != null) {
			$hof_sid = $hof->sid;
			$hof_name = $hof->getFullName();
			$address = $hof->address;
			$province_cd = $hof->province_cd;
			$postal_code = $hof->postal_code;
			$affiliation = $hof->affiliation;
		} else {
			$hof_sid = null;
			$hof_name = null;
			$address = Input::old ('address');
			$province_cd = Input::old ('province_cd');
			$postal_code = Input::old('postal_code');
			$affiliation = Input::old('affiliation');
		}
	?>
	{{ Form::hidden('head_of_family', $hof_sid, array('id' => 'head_of_family')) }}
	
	<div class="form-group">
		{{ Form::label('head_of_family_name', Lang::get('person.head_of_family'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-9">
			<div class="input-group">
			    {{ Form::text('head_of_family_name', $hof_name, array('class' => 'form-control', 'readonly'=>'readonly')) }}
				<span class="input-group-btn">
					<button class="btn btn-default" type="button" data-toggle="modal" data-target=".hof-selector-dialog">Search</button>
				</span>
			</div>
		</div>
		<div class="col-sm-1">
			<div class="checkbox">
				<label>
				  <input type="checkbox" name="self_hof"> Self
				</label>
			</div>
		</div>
	</div>

	<div class="form-group">
		{{ Form::label('id', Lang::get('person.id'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
			<?php $id = Input::old('id');
			if (empty($id)) $id = $auxdata['nextId']; ?>
		    {{ Form::text('id', $id, array('class' => 'form-control')) }}
		</div>
	</div>
 
	<div class="form-group">
		{{ Form::label('name_nl', Lang::get('person.name_nl'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('name_nl', Input::old('name_nl'), array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('alternate_name', Lang::get('person.alternate_name'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('alternate_name', Input::old('alternate_name'), array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('family_name', Lang::get('person.family_name'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('family_name', Input::old('family_name'), array('class' => 'form-control', 'required' => '')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('given_name', Lang::get('person.given_name'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('given_name', Input::old('given_name'), array('class' => 'form-control', 'required' => '')) }}
		</div>
	</div>
	<!--
	<div class="form-group">
		{{ Form::label('name', Lang::get('person.name'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('name', null, array('class' => 'form-control')) }}
		</div>
	</div>
	-->
	<div class="form-group">
		{{ Form::label('mobile_number', Lang::get('person.mobile_number'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('mobile_number', Input::old('mobile_number'), array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('telephone', Lang::get('person.telephone'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('telephone', Input::old('telephone'), array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('email', Lang::get('person.email'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('email', Input::old('email'), array('class' => 'form-control')) }}
		</div>
	</div>

	<div class="form-group">
		{{ Form::label('address', Lang::get('person.address'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('address', $address, array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('province_cd', Lang::get('person.province_cd'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('province_cd', $province_cd, array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('postal_code', Lang::get('person.postal_code'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('postal_code', $postal_code, array('class' => 'form-control')) }}
		</div>
	</div>

	<div class="form-group">
		{{ Form::label('affiliation', Lang::get('person.affiliation'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('affiliation', $affiliation, array('class' => 'form-control', 'required' => '')) }}
		</div>
	</div>

	<div class="form-group">
		{{ Form::label('description', Lang::get('person.description'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('description', Input::old('description'), array('class' => 'form-control')) }}
		</div>
	</div>

	<div class="form-group">
		{{ Form::label('highlight', Lang::get('person.highlight'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::textarea('highlight', Input::old('highlight'), array('class' => 'form-control', 'size' => '50x3')) }}
		</div>
	</div>

	<div class="form-group">
		{{ Form::label('status', Lang::get('person.status'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::select('status', $auxdata['status'], Input::old('status'), array('class' => 'form-control')) }}
		</div>
	</div>

	<div class="form-group">
    	<div class="col-sm-offset-2 col-sm-10">
	{{ Form::submit('Create', array('class' => 'btn btn-primary')) }}
	    </div>
	</div>

{{ Form::close() }}

<!-- Person select Dialog box -->
<div class="modal fade hof-selector-dialog" tabindex="-1" role="dialog" aria-labelledby="Head of Family Selector" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Select the Head of Family</h4>
      </div>
      <div class="modal-body">
      	<!-- form -->
      	<div class="col-xs-8 col-xs-offset-2">
			<div class="form-group">
				<div class="col-sm-5">
	            	<input type="text" class="form-control" id="hof_search_name_nl" placeholder="{{ Lang::get('person.name_nl') }}">
	            </div>
				<div class="col-sm-5">
		            <input type="text" class="form-control" id="hof_search_name" placeholder="{{ Lang::get('person.name') }}">
	            </div>
				<div class="col-sm-2">
	              <button type="submit" class="btn btn-default" ng-click="hofSearch()"><span class="glyphicon glyphicon-search"></span></button>
	            </div>
	        </div>
		</div>
		<!-- form -->

      	<table class="table table-striped">
      		<thead>
				<td>{{ Lang::get('person.name_nl') }}</td>
				<td>{{ Lang::get('person.alternate_name') }}</td>
				<td>{{ Lang::get('person.name') }}</td>
				<td>{{ Lang::get('person.affiliation') }}</td>
				<td>{{ Lang::get('person.email') }}</td>
      		</thead>
      		<tbody ng-repeat="person in hof_search_result">
      			<td>@{{ person.name_nl }}</td>
      			<td>{{ Lang::get('person.alternate_name') }}</td>
      			<td><a ng-click="hofSelect($index)"> @{{ person.name }}</a></td>
      			<td>@{{ person.affiliation }}</td>
      			<td>@{{ person.email }}</td>
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

</div> <!-- END-container -->

{{ HTML::script('js/ecofy_utils.js') }}
<script>

var myapp = angular.module('myapp', []);

myapp.controller('PersonFormCtrl', function($scope, $http) {

	// Head of Famly search result
	$scope.hof_search_result = [];

	// Angular's on document ready 
	angular.element(document).ready(function () {
        // Initilize Bootstrap tab
        $("#family_name").change(function(){
        	updateName();
        });
        $("#family_name").keyup(function(){
        	updateName();
        });
        $("#given_name").change(function(){
        	updateName();
        });
        $("#given_name").keyup(function(){
        	updateName();
        });
    });

    function updateName(){
    	var familyName = $("#family_name").val();
        var givenName = $("#given_name").val();
    	$("#name").val(familyName + ', ' + givenName);
    }

    // Selecting Head of Family
	$scope.hofSearch = function()
	{
		var name_nl = $('#hof_search_name_nl').val();
		var name = $('#hof_search_name').val();

		var filterParams = {
			"persons:name_nl-like": name_nl,
			"persons:name-like": name
		}
		var qstring = Utils.buildFilterQueryString(filterParams, true);

		var personsQueryUrl = '{{ URL::to(route('api.persons.index')) }}' + '?' + qstring;

		$http.get(personsQueryUrl).
			success(function(data, status, headers, config) {
		      $scope.hof_search_result = data;
		    }).
		    error(function(data, status, headers, config) {
		      alert ("Error retrieving child document");
		    });
	}

    $scope.hofSelect = function(index)
	{
		$('#head_of_family').val($scope.hof_search_result[index].sid);
		$('#head_of_family_name').val($scope.hof_search_result[index].name);
		$('.hof-selector-dialog').modal('hide');
	}

});

</script>
@show