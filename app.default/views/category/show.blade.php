
<!-- app/views/category/show.blade.php -->

@section('content')
<div class="container">

<!-- @todo: the field to be displayed as title -->

<h1>View {{ $record->sid }}</h1>

<dl class="dl-horizontal">
	<dt>{{ Lang::get('common.created_dt') }}</dt>
    <dd>{{ $record->created_dt }}</dd>
	<dt>{{ Lang::get('common.updated_dt') }}</dt>
    <dd>{{ $record->updated_dt }}</dd>
	<dt>{{ Lang::get('common.updated_counter') }}</dt>
    <dd>{{ $record->updated_counter }}</dd>
	<dt>{{ Lang::get('common.creator_sid') }}</dt>
    <dd>{{ $record->creator_sid }}</dd>
	<dt>{{ Lang::get('common.uuid') }}</dt>
    <dd>{{ $record->uuid }}</dd>
	<dt>{{ Lang::get('common.lang') }}</dt>
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
	<dt>{{ Lang::get('category.image_uri') }}</dt>
    <dd>{{ $record->image_uri }}</dd>
	<dt>{{ Lang::get('category.position') }}</dt>
    <dd>{{ $record->position }}</dd>
	<dt>{{ Lang::get('category.params_text') }}</dt>
    <dd>{{ $record->params_text }}</dd>
</dl>

</div> <!-- container -->
@show
