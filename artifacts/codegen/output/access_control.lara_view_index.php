
<!-- app/views/access_control/index.blade.php -->

@section('content')
<div class="container">

<h1>All the records</h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<a class="btn btn-small btn-success" href="{{ URL::to('access_controls/create') }}">Create</a>
<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<td>{{ Lang::get('access_control.sid') }}</td>
			<td>{{ Lang::get('access_control.uuid') }}</td>
			<td>{{ Lang::get('access_control.domain_sid') }}</td>
			<td>{{ Lang::get('access_control.domain_id') }}</td>
			<td>{{ Lang::get('access_control.created_by') }}</td>
			<td>{{ Lang::get('access_control.created_dt') }}</td>
			<td>{{ Lang::get('access_control.updated_by') }}</td>
			<td>{{ Lang::get('access_control.updated_dt') }}</td>
			<td>{{ Lang::get('access_control.update_counter') }}</td>
			<td>{{ Lang::get('access_control.lang') }}</td>
			<td>{{ Lang::get('access_control.role_sid') }}</td>
			<td>{{ Lang::get('access_control.service') }}</td>
			<td>{{ Lang::get('access_control.permissions') }}</td>
			<td>{{ Lang::get('access_control.policy') }}</td>
			<td>{{ Lang::get('access_control.params_text') }}</td>
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
			<td>{{ $value->role_sid }}</td>
			<td>{{ $value->service }}</td>
			<td>{{ $value->permissions }}</td>
			<td>{{ $value->policy }}</td>
			<td>{{ $value->params_text }}</td>

			<!-- we will also add show, edit, and delete buttons -->
			<td>

				<!-- show the record (uses the show method found at GET /access_controls/{id} -->
				<!-- @todo: Make sure that the 'id' is the correct primary key column on '$value->sid' -->
				<a class="btn btn-small btn-success" href="{{ URL::to('access_controls/' . $value->sid) }}">Show</a>

				<!-- edit this record (uses the edit method found at GET /access_controls/{id}/edit -->
				<a class="btn btn-small btn-info" href="{{ URL::to('access_controls/' . $value->sid . '/edit') }}"><span class="glyphicon glyphicon-pencil"></span></a>

				<!-- delete the record (uses the destroy method DESTROY /access_controls/{id} -->
                {{ Form::open(array('url' => 'access_controls/' . $value->sid, 'class' => '')) }}
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
