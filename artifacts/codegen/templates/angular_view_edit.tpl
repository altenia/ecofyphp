<%namespace name="common" file="/codegen_common.tpl"/><%

    def is_fillable(field):
        if (field['type'] == 'auto'):
            return False
        return True
%>
% for entity_name, entity_def in model['entities'].iteritems():
<!-- app/views/${entity_name}/edit.blade.php -->

@section('content')
<div class="container">

<div ng-controller="DocumentTypeFormCtrl">
<!-- @todo: properly set the field name to be displayed as title -->
<h1>Edit @{{ record.name }}</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

<!-- @todo: Make sure that the primaryKey column name is sid -->
{{ Form::model($record, array('route' => array('${common.get_plural(entity_name)}.update', $record->sid), 'method' => 'PUT', 'class' => 'form-horizontal')) }}

<!--
    @todo: Remove non-editable fields.
           Add client-side validation.
-->
% for field in entity_def['fields']:
    % if is_fillable(field):
	<div class="form-group">
		<label for="${field["name"]}" class="col-sm-2 control-label">{{ Lang::get('${entity_name}.${field["name"]}') }}</label>
		<div class="col-sm-10">
		    <input class="form-control" name="${field["name"]}" type="text" value="@{{ record.${field["name"]} }}" id="${field["name"]}">
		</div>
	</div>
	% endif
% endfor

	<div class="form-group">
    	<div class="col-sm-offset-2 col-sm-10">
	{{ Form::submit('Update', array('class' => 'btn btn-primary')) }}
	    </div>
	</div>

{{ Form::close() }}
</div> <!-- angular controller -->

<script>
angular.module('myApp', []).config(function($interpolateProvider){
        $interpolateProvider.startSymbol('${').endSymbol('}');
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
% endfor