
<!-- app/views/category/index.blade.php -->

@section('content')
<div class="container">

<h1>All the records</h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<td>{{ Lang::get('common.created_dt') }}</td>
			<td>{{ Lang::get('common.updated_dt') }}</td>
			<td>{{ Lang::get('common.lang') }}</td>
			<td>{{ Lang::get('category.parent_sid') }}</td>
			<td>{{ Lang::get('category.type') }}</td>
			<td>{{ Lang::get('category.name') }}</td>
			<td>{{ Lang::get('category.code') }}</td>
			<td>{{ Lang::get('category.description') }}</td>
			<td>{{ Lang::get('category.position') }}</td>
			<td>{{ Lang::get('common.actions') }}</td>
		</tr>
	</thead>
	<tbody>
	@foreach($records as $key => $value)
		<tr>
			<td title="by {{ $value->creator_sid }}">{{ $value->created_dt }}</td>
			<td title="count: {{ $value->updated_counter }}">{{ $value->updated_dt }}</td>
			<td>{{ $value->lang }}</td>
			<td>{{ $value->parent_sid }}</td>
			<td>{{ $value->type }}</td>
			<td title="sid={{ $value->sid }}, uuid={{ $value->uuid }}">{{ $value->name }}</td>
			<td>{{ $value->code }}</td>
			<td>{{ $value->description }}</td>
			<td>{{ $value->position }}</td>

			<!-- we will also add show, edit, and delete buttons -->
			<td>

				<!-- show the record (uses the show method found at GET /category/{id} -->
				<!-- @todo: Make sure that the 'id' is the correct primary key column on '$value->sid' -->
				<a class="btn btn-small btn-success" href="{{ URL::to('categories/' . $value->sid) }}">Show</a>

				<!-- edit this record (uses the edit method found at GET /category/{id}/edit -->
				<a class="btn btn-small btn-info" href="{{ URL::to('categories/' . $value->sid . '/edit') }}">Edit</a>

				<!-- delete the record (uses the destroy method DESTROY /category/{id} -->
                {{ Form::open(array('url' => 'categories/' . $value->sid, 'class' => 'form-action')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete', array('class' => 'btn btn-warning')) }}
                {{ Form::close() }}

			</td>
		</tr>
	@endforeach
	</tbody>
</table>

</div> <!-- container -->

<script>
$(document).ready(function() {
    $('.page-header').append(' <a class="btn btn-small btn-info" href="{{ URL::to(route('categories.create')) }}"><span class="glyphicon glyphicon-plus"></span> New</a>')
} );
</script>
@show
