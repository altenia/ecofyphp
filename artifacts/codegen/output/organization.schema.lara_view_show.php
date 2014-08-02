
<!-- app/views/organization/show.blade.php -->

@section('content')
<div class="container">

<!-- @todo: the field to be displayed as title -->

<h1>View {{ $record->sid }}</h1>

<dl class="dl-horizontal">
	<dt>{{ Lang::get('organization.uuid') }}</dt>
    <dd>{{ $record->uuid }}</dd>
	<dt>{{ Lang::get('organization.domain_sid') }}</dt>
    <dd>{{ $record->domain_sid }}</dd>
	<dt>{{ Lang::get('organization.domain_id') }}</dt>
    <dd>{{ $record->domain_id }}</dd>
	<dt>{{ Lang::get('organization.created_by') }}</dt>
    <dd>{{ $record->created_by }}</dd>
	<dt>{{ Lang::get('organization.created_dt') }}</dt>
    <dd>{{ $record->created_dt }}</dd>
	<dt>{{ Lang::get('organization.updated_by') }}</dt>
    <dd>{{ $record->updated_by }}</dd>
	<dt>{{ Lang::get('organization.updated_dt') }}</dt>
    <dd>{{ $record->updated_dt }}</dd>
	<dt>{{ Lang::get('organization.update_counter') }}</dt>
    <dd>{{ $record->update_counter }}</dd>
	<dt>{{ Lang::get('organization.lang') }}</dt>
    <dd>{{ $record->lang }}</dd>
	<dt>{{ Lang::get('organization.owner_sid') }}</dt>
    <dd>{{ $record->owner_sid }}</dd>
	<dt>{{ Lang::get('organization.parent_sid') }}</dt>
    <dd>{{ $record->parent_sid }}</dd>
	<dt>{{ Lang::get('organization.role_sid') }}</dt>
    <dd>{{ $record->role_sid }}</dd>
	<dt>{{ Lang::get('organization.role_name') }}</dt>
    <dd>{{ $record->role_name }}</dd>
	<dt>{{ Lang::get('organization.id') }}</dt>
    <dd>{{ $record->id }}</dd>
	<dt>{{ Lang::get('organization.name') }}</dt>
    <dd>{{ $record->name }}</dd>
	<dt>{{ Lang::get('organization.name_lc') }}</dt>
    <dd>{{ $record->name_lc }}</dd>
	<dt>{{ Lang::get('organization.category_sid') }}</dt>
    <dd>{{ $record->category_sid }}</dd>
	<dt>{{ Lang::get('organization.registration_type') }}</dt>
    <dd>{{ $record->registration_type }}</dd>
	<dt>{{ Lang::get('organization.registration_num') }}</dt>
    <dd>{{ $record->registration_num }}</dd>
	<dt>{{ Lang::get('organization.inet_domain_name') }}</dt>
    <dd>{{ $record->inet_domain_name }}</dd>
	<dt>{{ Lang::get('organization.url') }}</dt>
    <dd>{{ $record->url }}</dd>
	<dt>{{ Lang::get('organization.country_cd') }}</dt>
    <dd>{{ $record->country_cd }}</dd>
	<dt>{{ Lang::get('organization.province_cd') }}</dt>
    <dd>{{ $record->province_cd }}</dd>
	<dt>{{ Lang::get('organization.district') }}</dt>
    <dd>{{ $record->district }}</dd>
	<dt>{{ Lang::get('organization.address') }}</dt>
    <dd>{{ $record->address }}</dd>
	<dt>{{ Lang::get('organization.postal_code') }}</dt>
    <dd>{{ $record->postal_code }}</dd>
	<dt>{{ Lang::get('organization.slogan') }}</dt>
    <dd>{{ $record->slogan }}</dd>
	<dt>{{ Lang::get('organization.summary') }}</dt>
    <dd>{{ $record->summary }}</dd>
	<dt>{{ Lang::get('organization.description') }}</dt>
    <dd>{{ $record->description }}</dd>
	<dt>{{ Lang::get('organization.logo_image_uri') }}</dt>
    <dd>{{ $record->logo_image_uri }}</dd>
	<dt>{{ Lang::get('organization.cover_image_uri') }}</dt>
    <dd>{{ $record->cover_image_uri }}</dd>
	<dt>{{ Lang::get('organization.found_date') }}</dt>
    <dd>{{ $record->found_date }}</dd>
	<dt>{{ Lang::get('organization.status') }}</dt>
    <dd>{{ $record->status }}</dd>
	<dt>{{ Lang::get('organization.num_members') }}</dt>
    <dd>{{ $record->num_members }}</dd>
	<dt>{{ Lang::get('organization.num_comments') }}</dt>
    <dd>{{ $record->num_comments }}</dd>
	<dt>{{ Lang::get('organization.num_cheers') }}</dt>
    <dd>{{ $record->num_cheers }}</dd>
	<dt>{{ Lang::get('organization.params_text') }}</dt>
    <dd>{{ $record->params_text }}</dd>
</dl>

</div> <!-- container -->
@show
