
<!-- app/views/account/edit.blade.php -->

@section('content')
<div class="container">

<!-- @todo: Make sure that the primaryKey column name is sid -->
{{ Form::open(array('url' => 'import/form', 'class' => 'form-horizontal')) }}

	<div class="form-group">
		{{ Form::label('Type', Lang::get('import.type'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::select('type', $auxdata['opt_type'], $type, array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('OnMatch', Lang::get('import.onmatch'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::select('onmatch', $auxdata['opt_onmatch'], $onmatch, array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('KeyCol', Lang::get('import.keycols'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('keycols', $keycols, array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('Data', Lang::get('import.data'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::textarea('data', $data, array('class' => 'form-control', 'size' => '50x6')) }}
		</div>
	</div>
	<div class="form-group">
    	<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" name="mode" value="validate" class="btn btn-primary">{{ Lang::get('import.validate') }}</button>
@if (isset($isvalid) && $isvalid )
    		<button type="submit" name="mode" value="process" class="btn btn-primary">{{ Lang::get('import.process') }}</button>
@endif
	    </div>
	</div>

{{ Form::close() }}

@if (!empty($rows))
<h4><a name="result"></a>Parse result <small>(<a href="#result_stat">to stat</a>)</small></h4>
<table class="table table-striped">
	<thead> 
		<tr>
@foreach ($rows[0] as $header => $dummy)
			<th>{{ $header }}</th>
@endforeach
		</tr>
	</thead>
	<tbody> 
@foreach ($rows as $row)
		<tr>
@foreach ($row as $name => $val)
			<td>{{ $val }}</td>
@endforeach
		</tr>
@endforeach
	</tbody>
</table>
@endif

@if (isset($result) )
<h4><a name="result_stat" ></a>Stats <small>(<a href="#result" >to parse result</a>)</small></h4>
	@if (!$isvalid )
<h4>Errors</h4>
<ul>
@foreach ($result['errors'] as $error)
	<li>Line {{ $error['line'] }}: 
		@if (is_array($error['message'])):
			@foreach ($error['message'] as $field => $detail)
			[{{ $field }}] - <?php print_r($detail) ?>
			@endforeach
		@else
			{{ $error['message'] }}
		@endif
	</li>
@endforeach
<ul>
	@else
<dl>
	<dt>Total count</dt>
	<dd>{{ $result['items_count'] }}</dd>
	<dt>Items processed</dt>
	<dd><ul>
		<li>Created: {{ $result['items_created_count'] }} [{{ implode(', ', $result['items_created']) }}]</li>
		<li>Updated: {{ $result['items_updated_count'] }}  [{{ implode(', ', $result['items_updated']) }}]</li>
		</ul>
	</dd>
</dl>
	@endif
@endif

</div> <!-- container -->

<script>
$(document).ready(function() {

	
});
</script>

@show
