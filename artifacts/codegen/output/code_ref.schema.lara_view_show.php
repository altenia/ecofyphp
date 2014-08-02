
<!-- app/views/code_ref/show.blade.php -->

@section('content')
<div class="container">

<!-- @todo: the field to be displayed as title -->

<h1>View {{ $record->sid }}</h1>

<dl class="dl-horizontal">
	<dt>{{ Lang::get('code_ref.uuid') }}</dt>
    <dd>{{ $record->uuid }}</dd>
	<dt>{{ Lang::get('code_ref.domain_sid') }}</dt>
    <dd>{{ $record->domain_sid }}</dd>
	<dt>{{ Lang::get('code_ref.domain_id') }}</dt>
    <dd>{{ $record->domain_id }}</dd>
	<dt>{{ Lang::get('code_ref.created_by') }}</dt>
    <dd>{{ $record->created_by }}</dd>
	<dt>{{ Lang::get('code_ref.created_dt') }}</dt>
    <dd>{{ $record->created_dt }}</dd>
	<dt>{{ Lang::get('code_ref.updated_by') }}</dt>
    <dd>{{ $record->updated_by }}</dd>
	<dt>{{ Lang::get('code_ref.updated_dt') }}</dt>
    <dd>{{ $record->updated_dt }}</dd>
	<dt>{{ Lang::get('code_ref.update_counter') }}</dt>
    <dd>{{ $record->update_counter }}</dd>
	<dt>{{ Lang::get('code_ref.lang') }}</dt>
    <dd>{{ $record->lang }}</dd>
	<dt>{{ Lang::get('code_ref.parent_sid') }}</dt>
    <dd>{{ $record->parent_sid }}</dd>
	<dt>{{ Lang::get('code_ref.kind') }}</dt>
    <dd>{{ $record->kind }}</dd>
	<dt>{{ Lang::get('code_ref.name') }}</dt>
    <dd>{{ $record->name }}</dd>
	<dt>{{ Lang::get('code_ref.code') }}</dt>
    <dd>{{ $record->code }}</dd>
	<dt>{{ Lang::get('code_ref.abbreviation') }}</dt>
    <dd>{{ $record->abbreviation }}</dd>
	<dt>{{ Lang::get('code_ref.description') }}</dt>
    <dd>{{ $record->description }}</dd>
	<dt>{{ Lang::get('code_ref.position') }}</dt>
    <dd>{{ $record->position }}</dd>
	<dt>{{ Lang::get('code_ref.params_text') }}</dt>
    <dd>{{ $record->params_text }}</dd>
</dl>

</div> <!-- container -->
@show
