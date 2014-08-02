
<!-- app/views/domain/index.blade.php -->

@section('content')
<div class="container">

<h1>All the records</h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<a class="btn btn-small btn-success" href="{{ URL::to('domains/create') }}">Create</a>
<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<td>{{ Lang::get('domain.sid') }}</td>
			<td>{{ Lang::get('domain.creator_sid') }}</td>
			<td>{{ Lang::get('domain.created_dt') }}</td>
			<td>{{ Lang::get('domain.updated_by') }}</td>
			<td>{{ Lang::get('domain.updated_dt') }}</td>
			<td>{{ Lang::get('domain.update_counter') }}</td>
			<td>{{ Lang::get('domain.uuid') }}</td>
			<td>{{ Lang::get('domain.lang') }}</td>
			<td>{{ Lang::get('domain.owner_sid') }}</td>
			<td>{{ Lang::get('domain.parent_sid') }}</td>
			<td>{{ Lang::get('domain.category_sid') }}</td>
			<td>{{ Lang::get('domain.id') }}</td>
			<td>{{ Lang::get('domain.name') }}</td>
			<td>{{ Lang::get('domain.name_lc') }}</td>
			<td>{{ Lang::get('domain.intro') }}</td>
			<td>{{ Lang::get('domain.description') }}</td>
			<td>{{ Lang::get('domain.logo_image_url') }}</td>
			<td>{{ Lang::get('domain.cover_image_url') }}</td>
			<td>{{ Lang::get('domain.policy') }}</td>
			<td>{{ Lang::get('domain.privacy_level') }}</td>
			<td>{{ Lang::get('domain.type') }}</td>
			<td>{{ Lang::get('domain.active') }}</td>
			<td>{{ Lang::get('domain.status') }}</td>
			<td>{{ Lang::get('domain.num_users') }}</td>
			<td>{{ Lang::get('domain.num_organizations') }}</td>
			<td>{{ Lang::get('domain.params_text') }}</td>
            <td>Actions</td>
		</tr>
	</thead>
	<tbody>
	@foreach($records as $key => $value)
		<tr>
			<td>{{ $value->sid }}</td>
			<td>{{ $value->creator_sid }}</td>
			<td>{{ $value->created_dt }}</td>
			<td>{{ $value->updated_by }}</td>
			<td>{{ $value->updated_dt }}</td>
			<td>{{ $value->update_counter }}</td>
			<td>{{ $value->uuid }}</td>
			<td>{{ $value->lang }}</td>
			<td>{{ $value->owner_sid }}</td>
			<td>{{ $value->parent_sid }}</td>
			<td>{{ $value->category_sid }}</td>
			<td>{{ $value->id }}</td>
			<td>{{ $value->name }}</td>
			<td>{{ $value->name_lc }}</td>
			<td>{{ $value->intro }}</td>
			<td>{{ $value->description }}</td>
			<td>{{ $value->logo_image_url }}</td>
			<td>{{ $value->cover_image_url }}</td>
			<td>{{ $value->policy }}</td>
			<td>{{ $value->privacy_level }}</td>
			<td>{{ $value->type }}</td>
			<td>{{ $value->active }}</td>
			<td>{{ $value->status }}</td>
			<td>{{ $value->num_users }}</td>
			<td>{{ $value->num_organizations }}</td>
			<td>{{ $value->params_text }}</td>

			<!-- we will also add show, edit, and delete buttons -->
			<td>

				<!-- show the record (uses the show method found at GET /domains/{id} -->
				<!-- @todo: Make sure that the 'id' is the correct primary key column on '$value->sid' -->
				<a class="btn btn-small btn-success" href="{{ URL::to('domains/' . $value->sid) }}">Show</a>

				<!-- edit this record (uses the edit method found at GET /domains/{id}/edit -->
				<a class="btn btn-small btn-info" href="{{ URL::to('domains/' . $value->sid . '/edit') }}"><span class="glyphicon glyphicon-pencil"></span></a>

				<!-- delete the record (uses the destroy method DESTROY /domains/{id} -->
                {{ Form::open(array('url' => 'domains/' . $value->sid, 'class' => '')) }}
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
