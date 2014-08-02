
<!-- app/views/category/index.blade.php -->

@section('content')
<div class="container">

<h1>All the records</h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<a class="btn btn-small btn-success" href="{{ URL::to('categories/create') }}">Create</a>
<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<td>{{ Lang::get('category.sid') }}</td>
			<td>{{ Lang::get('category.uuid') }}</td>
			<td>{{ Lang::get('category.domain_sid') }}</td>
			<td>{{ Lang::get('category.domain_id') }}</td>
			<td>{{ Lang::get('category.created_by') }}</td>
			<td>{{ Lang::get('category.created_dt') }}</td>
			<td>{{ Lang::get('category.updated_by') }}</td>
			<td>{{ Lang::get('category.updated_dt') }}</td>
			<td>{{ Lang::get('category.update_counter') }}</td>
			<td>{{ Lang::get('category.lang') }}</td>
			<td>{{ Lang::get('category.parent_sid') }}</td>
			<td>{{ Lang::get('category.type') }}</td>
			<td>{{ Lang::get('category.name') }}</td>
			<td>{{ Lang::get('category.code') }}</td>
			<td>{{ Lang::get('category.description') }}</td>
			<td>{{ Lang::get('category.image_url') }}</td>
			<td>{{ Lang::get('category.position') }}</td>
			<td>{{ Lang::get('category.params_text') }}</td>
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
			<td>{{ $value->parent_sid }}</td>
			<td>{{ $value->type }}</td>
			<td>{{ $value->name }}</td>
			<td>{{ $value->code }}</td>
			<td>{{ $value->description }}</td>
			<td>{{ $value->image_url }}</td>
			<td>{{ $value->position }}</td>
			<td>{{ $value->params_text }}</td>

			<!-- we will also add show, edit, and delete buttons -->
			<td>

				<!-- show the record (uses the show method found at GET /categories/{id} -->
				<!-- @todo: Make sure that the 'id' is the correct primary key column on '$value->sid' -->
				<a class="btn btn-small btn-success" href="{{ URL::to('categories/' . $value->sid) }}">Show</a>

				<!-- edit this record (uses the edit method found at GET /categories/{id}/edit -->
				<a class="btn btn-small btn-info" href="{{ URL::to('categories/' . $value->sid . '/edit') }}"><span class="glyphicon glyphicon-pencil"></span></a>

				<!-- delete the record (uses the destroy method DESTROY /categories/{id} -->
                {{ Form::open(array('url' => 'categories/' . $value->sid, 'class' => '')) }}
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
