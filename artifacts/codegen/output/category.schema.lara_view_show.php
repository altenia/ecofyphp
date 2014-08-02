
<!-- app/views/category/show.blade.php -->

@section('content')
<div class="container">

<!-- @todo: the field to be displayed as title -->

<h1>View {{ $record->sid }}</h1>

<dl class="dl-horizontal">
	<dt>{{ Lang::get('category.uuid') }}</dt>
    <dd>{{ $record->uuid }}</dd>
	<dt>{{ Lang::get('category.domain_sid') }}</dt>
    <dd>{{ $record->domain_sid }}</dd>
	<dt>{{ Lang::get('category.domain_id') }}</dt>
    <dd>{{ $record->domain_id }}</dd>
	<dt>{{ Lang::get('category.created_by') }}</dt>
    <dd>{{ $record->created_by }}</dd>
	<dt>{{ Lang::get('category.created_dt') }}</dt>
    <dd>{{ $record->created_dt }}</dd>
	<dt>{{ Lang::get('category.updated_by') }}</dt>
    <dd>{{ $record->updated_by }}</dd>
	<dt>{{ Lang::get('category.updated_dt') }}</dt>
    <dd>{{ $record->updated_dt }}</dd>
	<dt>{{ Lang::get('category.update_counter') }}</dt>
    <dd>{{ $record->update_counter }}</dd>
	<dt>{{ Lang::get('category.lang') }}</dt>
    <dd>{{ $record->lang }}</dd>
	<dt>{{ Lang::get('category.parent_sid') }}</dt>
    <dd>{{ $record->parent_sid }}</dd>
	<dt>{{ Lang::get('category.type') }}</dt>
    <dd>{{ $record->type }}</dd>
	<dt>{{ Lang::get('category.name') }}</dt>
    <dd>{{ $record->name }}</dd>
	<dt>{{ Lang::get('category.code') }}</dt>
    <dd>{{ $record->code }}</dd>
	<dt>{{ Lang::get('category.description') }}</dt>
    <dd>{{ $record->description }}</dd>
	<dt>{{ Lang::get('category.image_url') }}</dt>
    <dd>{{ $record->image_url }}</dd>
	<dt>{{ Lang::get('category.position') }}</dt>
    <dd>{{ $record->position }}</dd>
	<dt>{{ Lang::get('category.params_text') }}</dt>
    <dd>{{ $record->params_text }}</dd>
</dl>

</div> <!-- container -->
@show
