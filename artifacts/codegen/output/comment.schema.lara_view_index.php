
<!-- app/views/comment/index.blade.php -->

@section('content')
<div class="container">

<h1>All the records</h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<a class="btn btn-small btn-success" href="{{ URL::to('comments/create') }}">Create</a>
<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<td>{{ Lang::get('comment.sid') }}</td>
			<td>{{ Lang::get('comment.uuid') }}</td>
			<td>{{ Lang::get('comment.domain_sid') }}</td>
			<td>{{ Lang::get('comment.domain_id') }}</td>
			<td>{{ Lang::get('comment.created_by') }}</td>
			<td>{{ Lang::get('comment.created_dt') }}</td>
			<td>{{ Lang::get('comment.updated_by') }}</td>
			<td>{{ Lang::get('comment.updated_dt') }}</td>
			<td>{{ Lang::get('comment.update_counter') }}</td>
			<td>{{ Lang::get('comment.lang') }}</td>
			<td>{{ Lang::get('comment.object_type') }}</td>
			<td>{{ Lang::get('comment.object_sid') }}</td>
			<td>{{ Lang::get('comment.title') }}</td>
			<td>{{ Lang::get('comment.content') }}</td>
			<td>{{ Lang::get('comment.attachments') }}</td>
			<td>{{ Lang::get('comment.privacy_level') }}</td>
			<td>{{ Lang::get('comment.params_text') }}</td>
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
			<td>{{ $value->object_type }}</td>
			<td>{{ $value->object_sid }}</td>
			<td>{{ $value->title }}</td>
			<td>{{ $value->content }}</td>
			<td>{{ $value->attachments }}</td>
			<td>{{ $value->privacy_level }}</td>
			<td>{{ $value->params_text }}</td>

			<!-- we will also add show, edit, and delete buttons -->
			<td>

				<!-- show the record (uses the show method found at GET /comments/{id} -->
				<!-- @todo: Make sure that the 'id' is the correct primary key column on '$value->sid' -->
				<a class="btn btn-small btn-success" href="{{ URL::to('comments/' . $value->sid) }}">Show</a>

				<!-- edit this record (uses the edit method found at GET /comments/{id}/edit -->
				<a class="btn btn-small btn-info" href="{{ URL::to('comments/' . $value->sid . '/edit') }}"><span class="glyphicon glyphicon-pencil"></span></a>

				<!-- delete the record (uses the destroy method DESTROY /comments/{id} -->
                {{ Form::open(array('url' => 'comments/' . $value->sid, 'class' => '')) }}
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
