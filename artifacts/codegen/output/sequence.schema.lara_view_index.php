
<!-- app/views/sequence_number/index.blade.php -->

@section('content')
<div class="container">

<h1>All the records</h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<a class="btn btn-small btn-success" href="{{ URL::to('sequence_numbers/create') }}">Create</a>
<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<td>{{ Lang::get('sequence_number.sid') }}</td>
			<td>{{ Lang::get('sequence_number.uuid') }}</td>
			<td>{{ Lang::get('sequence_number.domain_sid') }}</td>
			<td>{{ Lang::get('sequence_number.domain_id') }}</td>
			<td>{{ Lang::get('sequence_number.created_by') }}</td>
			<td>{{ Lang::get('sequence_number.created_dt') }}</td>
			<td>{{ Lang::get('sequence_number.updated_by') }}</td>
			<td>{{ Lang::get('sequence_number.updated_dt') }}</td>
			<td>{{ Lang::get('sequence_number.update_counter') }}</td>
			<td>{{ Lang::get('sequence_number.lang') }}</td>
			<td>{{ Lang::get('sequence_number.id') }}</td>
			<td>{{ Lang::get('sequence_number.description') }}</td>
			<td>{{ Lang::get('sequence_number.seq') }}</td>
            <td>Actions</td>
		</tr>
	</thead>
	<tbody>
	@foreach($records as $key => $value)
		<tr>
			<td>{{ $value->sid }}</td>
			<td>{{ $value->uuid }}</td>
			<td>{{ $value->domain_sid }}</td>
			<td>{{ $value->domain_id }}</td>
			<td>{{ $value->created_by }}</td>
			<td>{{ $value->created_dt }}</td>
			<td>{{ $value->updated_by }}</td>
			<td>{{ $value->updated_dt }}</td>
			<td>{{ $value->update_counter }}</td>
			<td>{{ $value->lang }}</td>
			<td>{{ $value->id }}</td>
			<td>{{ $value->description }}</td>
			<td>{{ $value->seq }}</td>

			<!-- we will also add show, edit, and delete buttons -->
			<td>

				<!-- show the record (uses the show method found at GET /sequence_numbers/{id} -->
				<!-- @todo: Make sure that the 'id' is the correct primary key column on '$value->sid' -->
				<a class="btn btn-small btn-success" href="{{ URL::to('sequence_numbers/' . $value->sid) }}">Show</a>

				<!-- edit this record (uses the edit method found at GET /sequence_numbers/{id}/edit -->
				<a class="btn btn-small btn-info" href="{{ URL::to('sequence_numbers/' . $value->sid . '/edit') }}"><span class="glyphicon glyphicon-pencil"></span></a>

				<!-- delete the record (uses the destroy method DESTROY /sequence_numbers/{id} -->
                {{ Form::open(array('url' => 'sequence_numbers/' . $value->sid, 'class' => '')) }}
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
