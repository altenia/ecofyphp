
<!-- app/views/domain/show.blade.php -->

@section('content')
<div class="container">

<!-- @todo: the field to be displayed as title -->

<h1>View {{ $record->sid }}</h1>

<dl class="dl-horizontal">
	<dt>{{ Lang::get('domain.creator_sid') }}</dt>
    <dd>{{ $record->creator_sid }}</dd>
	<dt>{{ Lang::get('domain.created_dt') }}</dt>
    <dd>{{ $record->created_dt }}</dd>
	<dt>{{ Lang::get('domain.updated_by') }}</dt>
    <dd>{{ $record->updated_by }}</dd>
	<dt>{{ Lang::get('domain.updated_dt') }}</dt>
    <dd>{{ $record->updated_dt }}</dd>
	<dt>{{ Lang::get('domain.update_counter') }}</dt>
    <dd>{{ $record->update_counter }}</dd>
	<dt>{{ Lang::get('domain.uuid') }}</dt>
    <dd>{{ $record->uuid }}</dd>
	<dt>{{ Lang::get('domain.lang') }}</dt>
    <dd>{{ $record->lang }}</dd>
	<dt>{{ Lang::get('domain.owner_sid') }}</dt>
    <dd>{{ $record->owner_sid }}</dd>
	<dt>{{ Lang::get('domain.parent_sid') }}</dt>
    <dd>{{ $record->parent_sid }}</dd>
	<dt>{{ Lang::get('domain.category_sid') }}</dt>
    <dd>{{ $record->category_sid }}</dd>
	<dt>{{ Lang::get('domain.id') }}</dt>
    <dd>{{ $record->id }}</dd>
	<dt>{{ Lang::get('domain.name') }}</dt>
    <dd>{{ $record->name }}</dd>
	<dt>{{ Lang::get('domain.name_lc') }}</dt>
    <dd>{{ $record->name_lc }}</dd>
	<dt>{{ Lang::get('domain.intro') }}</dt>
    <dd>{{ $record->intro }}</dd>
	<dt>{{ Lang::get('domain.description') }}</dt>
    <dd>{{ $record->description }}</dd>
	<dt>{{ Lang::get('domain.logo_image_url') }}</dt>
    <dd>{{ $record->logo_image_url }}</dd>
	<dt>{{ Lang::get('domain.cover_image_url') }}</dt>
    <dd>{{ $record->cover_image_url }}</dd>
	<dt>{{ Lang::get('domain.policy') }}</dt>
    <dd>{{ $record->policy }}</dd>
	<dt>{{ Lang::get('domain.privacy_level') }}</dt>
    <dd>{{ $record->privacy_level }}</dd>
	<dt>{{ Lang::get('domain.type') }}</dt>
    <dd>{{ $record->type }}</dd>
	<dt>{{ Lang::get('domain.active') }}</dt>
    <dd>{{ $record->active }}</dd>
	<dt>{{ Lang::get('domain.status') }}</dt>
    <dd>{{ $record->status }}</dd>
	<dt>{{ Lang::get('domain.num_users') }}</dt>
    <dd>{{ $record->num_users }}</dd>
	<dt>{{ Lang::get('domain.num_organizations') }}</dt>
    <dd>{{ $record->num_organizations }}</dd>
	<dt>{{ Lang::get('domain.params_text') }}</dt>
    <dd>{{ $record->params_text }}</dd>
</dl>

</div> <!-- container -->
@show
