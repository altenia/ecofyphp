
<!-- app/views/custom_field/index.blade.php -->

@section('content')
<div class="container">

<h1>All the records</h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<a class="btn btn-small btn-success" href="{{ URL::to('custom_fields/create') }}">Create</a>
<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<td>{{ Lang::get('custom_field.sid') }}</td>
			<td>{{ Lang::get('custom_field.domain_sid') }}</td>
			<td>{{ Lang::get('custom_field.type') }}</td>
			<td>{{ Lang::get('custom_field.field_name') }}</td>
			<td>{{ Lang::get('custom_field.data_type') }}</td>
			<td>{{ Lang::get('custom_field.value') }}</td>
            <td>Actions</td>
		</tr>
	</thead>
	<tbody>
	@foreach($records as $key => $value)
		<tr>
			<td>{{ $value->sid }}</td>
			<td>{{ $value->domain_sid }}</td>
			<td>{{ $value->type }}</td>
			<td>{{ $value->field_name }}</td>
			<td>{{ $value->data_type }}</td>
			<td>{{ $value->value }}</td>

			<!-- we will also add show, edit, and delete buttons -->
			<td>

				<!-- show the record (uses the show method found at GET /custom_fields/{id} -->
				<!-- @todo: Make sure that the 'id' is the correct primary key column on '$value->sid' -->
				<a class="btn btn-small btn-success" href="{{ URL::to('custom_fields/' . $value->sid) }}">Show</a>

				<!-- edit this record (uses the edit method found at GET /custom_fields/{id}/edit -->
				<a class="btn btn-small btn-info" href="{{ URL::to('custom_fields/' . $value->sid . '/edit') }}"><span class="glyphicon glyphicon-pencil"></span></a>

				<!-- delete the record (uses the destroy method DESTROY /custom_fields/{id} -->
                {{ Form::open(array('url' => 'custom_fields/' . $value->sid, 'class' => '')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    <button title="Delete" type="button" class="btn btn-small btn-danger">
					  <span class="glyphicon glyphicon-trash"></span>
					</button>
                {{ Form::close() }}

			</td>
		</tr>
	@endforeach
	</tbody>
</table>

<div class="text-center">
    <div class="pagination">
<?php echo $records->appends($qparams)->links(); ?>
	</div>
</div>

</div> <!-- container -->
@show
