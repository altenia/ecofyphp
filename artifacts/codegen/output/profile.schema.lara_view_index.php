
<!-- app/views/user/index.blade.php -->

@section('content')
<div class="container">

<h1>All the records</h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<a class="btn btn-small btn-success" href="{{ URL::to('users/create') }}">Create</a>
<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<td>{{ Lang::get('user.sid') }}</td>
			<td>{{ Lang::get('user.uuid') }}</td>
			<td>{{ Lang::get('user.domain_sid') }}</td>
			<td>{{ Lang::get('user.domain_id') }}</td>
			<td>{{ Lang::get('user.created_by') }}</td>
			<td>{{ Lang::get('user.created_dt') }}</td>
			<td>{{ Lang::get('user.updated_by') }}</td>
			<td>{{ Lang::get('user.updated_dt') }}</td>
			<td>{{ Lang::get('user.update_counter') }}</td>
			<td>{{ Lang::get('user.lang') }}</td>
			<td>{{ Lang::get('user.user_sid') }}</td>
			<td>{{ Lang::get('user.first_name') }}</td>
			<td>{{ Lang::get('user.middle_name') }}</td>
			<td>{{ Lang::get('user.last_name') }}</td>
			<td>{{ Lang::get('user.lc_name') }}</td>
			<td>{{ Lang::get('user.alt_name') }}</td>
			<td>{{ Lang::get('user.primary_lang') }}</td>
			<td>{{ Lang::get('user.nationality_cd') }}</td>
			<td>{{ Lang::get('user.hometown') }}</td>
			<td>{{ Lang::get('user.gender') }}</td>
			<td>{{ Lang::get('user.dob') }}</td>
			<td>{{ Lang::get('user.education_level') }}</td>
			<td>{{ Lang::get('user.highlight') }}</td>
			<td>{{ Lang::get('user.philosophy') }}</td>
			<td>{{ Lang::get('user.goals') }}</td>
			<td>{{ Lang::get('user.personality_type') }}</td>
			<td>{{ Lang::get('user.location') }}</td>
			<td>{{ Lang::get('user.country_cd') }}</td>
			<td>{{ Lang::get('user.province_cd') }}</td>
			<td>{{ Lang::get('user.district') }}</td>
			<td>{{ Lang::get('user.address') }}</td>
			<td>{{ Lang::get('user.postal_code') }}</td>
			<td>{{ Lang::get('user.privacy_level') }}</td>
			<td>{{ Lang::get('user.activity_index') }}</td>
			<td>{{ Lang::get('user.params_text') }}</td>
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
			<td>{{ $value->user_sid }}</td>
			<td>{{ $value->first_name }}</td>
			<td>{{ $value->middle_name }}</td>
			<td>{{ $value->last_name }}</td>
			<td>{{ $value->lc_name }}</td>
			<td>{{ $value->alt_name }}</td>
			<td>{{ $value->primary_lang }}</td>
			<td>{{ $value->nationality_cd }}</td>
			<td>{{ $value->hometown }}</td>
			<td>{{ $value->gender }}</td>
			<td>{{ $value->dob }}</td>
			<td>{{ $value->education_level }}</td>
			<td>{{ $value->highlight }}</td>
			<td>{{ $value->philosophy }}</td>
			<td>{{ $value->goals }}</td>
			<td>{{ $value->personality_type }}</td>
			<td>{{ $value->location }}</td>
			<td>{{ $value->country_cd }}</td>
			<td>{{ $value->province_cd }}</td>
			<td>{{ $value->district }}</td>
			<td>{{ $value->address }}</td>
			<td>{{ $value->postal_code }}</td>
			<td>{{ $value->privacy_level }}</td>
			<td>{{ $value->activity_index }}</td>
			<td>{{ $value->params_text }}</td>

			<!-- we will also add show, edit, and delete buttons -->
			<td>

				<!-- show the record (uses the show method found at GET /users/{id} -->
				<!-- @todo: Make sure that the 'id' is the correct primary key column on '$value->sid' -->
				<a class="btn btn-small btn-success" href="{{ URL::to('users/' . $value->sid) }}">Show</a>

				<!-- edit this record (uses the edit method found at GET /users/{id}/edit -->
				<a class="btn btn-small btn-info" href="{{ URL::to('users/' . $value->sid . '/edit') }}"><span class="glyphicon glyphicon-pencil"></span></a>

				<!-- delete the record (uses the destroy method DESTROY /users/{id} -->
                {{ Form::open(array('url' => 'users/' . $value->sid, 'class' => '')) }}
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
