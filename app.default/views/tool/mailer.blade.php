
<!-- app/views/account/edit.blade.php -->

@section('content')
<div class="container">

<!-- @todo: Make sure that the primaryKey column name is sid -->
{{ Form::open(array('url' => 'mailer/form', 'class' => 'form-horizontal')) }}

	<div class="form-group">
		{{ Form::label('Type', Lang::get('mailer.type'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::select('type', $auxdata['opt_type'], $type, array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('DataQuery', Lang::get('mailer.dataQuery'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('dataQuery', $dataQuery, array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('DataQuery', Lang::get('mailer.pagination'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-5">
		    Page Num {{ Form::text('pageNum', $pageNum, array('class' => 'form-control', 'style' => 'width: 150px')) }}
		</div>
	    <div class="col-sm-5">
		    Page Size {{ Form::text('pageSize', $pageSize, array('class' => 'form-control', 'style' => 'width: 150px')) }}
		</div>
	</div>

	<div class="form-group">
		{{ Form::label('subjectTemplate', Lang::get('mailer.subjectTemplate'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::text('subjectTemplate', $subjectTemplate, array('class' => 'form-control')) }}
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('Data', Lang::get('mailer.bodyTemplate'), array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
		    {{ Form::textarea('bodyTemplate', $bodyTemplate, array('class' => 'form-control', 'size' => '50x6')) }}
		</div>
	</div>
	<div class="form-group">
    	<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" name="mode" value="preview" class="btn btn-primary">{{ Lang::get('mailer.preview') }}</button>
    		<button type="submit" name="mode" value="process" class="btn btn-primary">{{ Lang::get('mailer.process') }}</button>
	    </div>
	</div>

{{ Form::close() }}

@if (!empty($result) && array_key_exists('preview', $result))
<h4><a name="result"></a>Parse result <small>(<a href="#result_stat">to stat</a>)</small></h4>
<table class="table table-striped">
	<thead> 
		<tr>
			<th>{{ Lang::get('mailer.recipients') }}</th>
			<th>{{ Lang::get('mailer.subject') }} / {{ Lang::get('mailer.body') }} </th>
		</tr>
	</thead>
	<tbody> 
@foreach ($result['preview'] as $row)
		<tr>
			<td>[{{ $row['status'] }}] {{ $row['recipients'] }}</td>
			<td><b>{{ $row['subject'] }}</b><br />
				<pre>{{ $row['body'] }}</pre>
			</td>
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
	<dt>Items processed</dt>
	<dd>TBD
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
