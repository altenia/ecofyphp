
<!-- app/views/organization/index.blade.php -->

@section('content')
<div class="container">

<h1>All the records</h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<a class="btn btn-small btn-success" href="{{ URL::to('organizations/create') }}">Create</a>
<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<td>{{ Lang::get('organization.sid') }}</td>
			<td>{{ Lang::get('organization.uuid') }}</td>
			<td>{{ Lang::get('organization.domain_sid') }}</td>
			<td>{{ Lang::get('organization.domain_id') }}</td>
			<td>{{ Lang::get('organization.created_by') }}</td>
			<td>{{ Lang::get('organization.created_dt') }}</td>
			<td>{{ Lang::get('organization.updated_by') }}</td>
			<td>{{ Lang::get('organization.updated_dt') }}</td>
			<td>{{ Lang::get('organization.update_counter') }}</td>
			<td>{{ Lang::get('organization.lang') }}</td>
			<td>{{ Lang::get('organization.owner_sid') }}</td>
			<td>{{ Lang::get('organization.parent_sid') }}</td>
			<td>{{ Lang::get('organization.role_sid') }}</td>
			<td>{{ Lang::get('organization.role_name') }}</td>
			<td>{{ Lang::get('organization.id') }}</td>
			<td>{{ Lang::get('organization.name') }}</td>
			<td>{{ Lang::get('organization.name_lc') }}</td>
			<td>{{ Lang::get('organization.category_sid') }}</td>
			<td>{{ Lang::get('organization.registration_type') }}</td>
			<td>{{ Lang::get('organization.registration_num') }}</td>
			<td>{{ Lang::get('organization.inet_domain_name') }}</td>
			<td>{{ Lang::get('organization.url') }}</td>
			<td>{{ Lang::get('organization.country_cd') }}</td>
			<td>{{ Lang::get('organization.province_cd') }}</td>
			<td>{{ Lang::get('organization.district') }}</td>
			<td>{{ Lang::get('organization.address') }}</td>
			<td>{{ Lang::get('organization.postal_code') }}</td>
			<td>{{ Lang::get('organization.slogan') }}</td>
			<td>{{ Lang::get('organization.summary') }}</td>
			<td>{{ Lang::get('organization.description') }}</td>
			<td>{{ Lang::get('organization.logo_image_uri') }}</td>
			<td>{{ Lang::get('organization.cover_image_uri') }}</td>
			<td>{{ Lang::get('organization.found_date') }}</td>
			<td>{{ Lang::get('organization.status') }}</td>
			<td>{{ Lang::get('organization.num_members') }}</td>
			<td>{{ Lang::get('organization.num_comments') }}</td>
			<td>{{ Lang::get('organization.num_cheers') }}</td>
			<td>{{ Lang::get('organization.params_text') }}</td>
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
			<td>{{ $value->owner_sid }}</td>
			<td>{{ $value->parent_sid }}</td>
			<td>{{ $value->role_sid }}</td>
			<td>{{ $value->role_name }}</td>
			<td>{{ $value->id }}</td>
			<td>{{ $value->name }}</td>
			<td>{{ $value->name_lc }}</td>
			<td>{{ $value->category_sid }}</td>
			<td>{{ $value->registration_type }}</td>
			<td>{{ $value->registration_num }}</td>
			<td>{{ $value->inet_domain_name }}</td>
			<td>{{ $value->url }}</td>
			<td>{{ $value->country_cd }}</td>
			<td>{{ $value->province_cd }}</td>
			<td>{{ $value->district }}</td>
			<td>{{ $value->address }}</td>
			<td>{{ $value->postal_code }}</td>
			<td>{{ $value->slogan }}</td>
			<td>{{ $value->summary }}</td>
			<td>{{ $value->description }}</td>
			<td>{{ $value->logo_image_uri }}</td>
			<td>{{ $value->cover_image_uri }}</td>
			<td>{{ $value->found_date }}</td>
			<td>{{ $value->status }}</td>
			<td>{{ $value->num_members }}</td>
			<td>{{ $value->num_comments }}</td>
			<td>{{ $value->num_cheers }}</td>
			<td>{{ $value->params_text }}</td>

			<!-- we will also add show, edit, and delete buttons -->
			<td>

				<!-- show the record (uses the show method found at GET /organizations/{id} -->
				<!-- @todo: Make sure that the 'id' is the correct primary key column on '$value->sid' -->
				<a class="btn btn-small btn-success" href="{{ URL::to('organizations/' . $value->sid) }}">Show</a>

				<!-- edit this record (uses the edit method found at GET /organizations/{id}/edit -->
				<a class="btn btn-small btn-info" href="{{ URL::to('organizations/' . $value->sid . '/edit') }}"><span class="glyphicon glyphicon-pencil"></span></a>

				<!-- delete the record (uses the destroy method DESTROY /organizations/{id} -->
                {{ Form::open(array('url' => 'organizations/' . $value->sid, 'class' => '')) }}
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
