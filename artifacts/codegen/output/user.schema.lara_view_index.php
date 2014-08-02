
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
			<td>{{ Lang::get('user.organization_sid') }}</td>
			<td>{{ Lang::get('user.role_sid') }}</td>
			<td>{{ Lang::get('user.role_name') }}</td>
			<td>{{ Lang::get('user.id') }}</td>
			<td>{{ Lang::get('user.password') }}</td>
			<td>{{ Lang::get('user.first_name') }}</td>
			<td>{{ Lang::get('user.middle_name') }}</td>
			<td>{{ Lang::get('user.last_name') }}</td>
			<td>{{ Lang::get('user.lc_name') }}</td>
			<td>{{ Lang::get('user.display_name') }}</td>
			<td>{{ Lang::get('user.dob') }}</td>
			<td>{{ Lang::get('user.phone') }}</td>
			<td>{{ Lang::get('user.email') }}</td>
			<td>{{ Lang::get('user.timezone') }}</td>
			<td>{{ Lang::get('user.type') }}</td>
			<td>{{ Lang::get('user.permalink') }}</td>
			<td>{{ Lang::get('user.profile_image_url') }}</td>
			<td>{{ Lang::get('user.activation_code') }}</td>
			<td>{{ Lang::get('user.security_question') }}</td>
			<td>{{ Lang::get('user.security_answer') }}</td>
			<td>{{ Lang::get('user.session_timestamp') }}</td>
			<td>{{ Lang::get('user.last_session_ip') }}</td>
			<td>{{ Lang::get('user.last_session_dt') }}</td>
			<td>{{ Lang::get('user.login_fail_counter') }}</td>
			<td>{{ Lang::get('user.active') }}</td>
			<td>{{ Lang::get('user.status') }}</td>
			<td>{{ Lang::get('user.default_lang_cd') }}</td>
			<td>{{ Lang::get('user.expiry_dt') }}</td>
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
			<td>{{ $value->organization_sid }}</td>
			<td>{{ $value->role_sid }}</td>
			<td>{{ $value->role_name }}</td>
			<td>{{ $value->id }}</td>
			<td>{{ $value->password }}</td>
			<td>{{ $value->first_name }}</td>
			<td>{{ $value->middle_name }}</td>
			<td>{{ $value->last_name }}</td>
			<td>{{ $value->lc_name }}</td>
			<td>{{ $value->display_name }}</td>
			<td>{{ $value->dob }}</td>
			<td>{{ $value->phone }}</td>
			<td>{{ $value->email }}</td>
			<td>{{ $value->timezone }}</td>
			<td>{{ $value->type }}</td>
			<td>{{ $value->permalink }}</td>
			<td>{{ $value->profile_image_url }}</td>
			<td>{{ $value->activation_code }}</td>
			<td>{{ $value->security_question }}</td>
			<td>{{ $value->security_answer }}</td>
			<td>{{ $value->session_timestamp }}</td>
			<td>{{ $value->last_session_ip }}</td>
			<td>{{ $value->last_session_dt }}</td>
			<td>{{ $value->login_fail_counter }}</td>
			<td>{{ $value->active }}</td>
			<td>{{ $value->status }}</td>
			<td>{{ $value->default_lang_cd }}</td>
			<td>{{ $value->expiry_dt }}</td>
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
