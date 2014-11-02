
<!-- app/views/organization/show.blade.php -->

@section('content')
<div class="container">

<!-- @todo: the field to be displayed as title -->

<dl class="dl-horizontal">
	<dt>{{ Lang::get('common.created_dt') }}</dt>
    <dd>{{ $record->created_dt }}</dd>
	<dt>{{ Lang::get('common.updated_dt') }}</dt>
    <dd>{{ $record->updated_dt }}</dd>
	<dt>{{ Lang::get('common.update_counter') }}</dt>
    <dd>{{ $record->update_counter }}</dd>
	<dt>{{ Lang::get('common.owner_sid') }}</dt>
    <dd>{{ $record->owner_sid }}</dd>
	<dt>{{ Lang::get('common.uuid') }}</dt>
    <dd>{{ $record->uuid }}</dd>
	<dt>{{ Lang::get('organization.lang') }}</dt>
    <dd>{{ $record->lang }}</dd>
	<dt>{{ Lang::get('organization.role') }}</dt>
    <dd>{{ $record->role_sid }}</dd>
	<dt>{{ Lang::get('organization.name') }}</dt>
    <dd>{{ $record->name }}</dd>
	<dt>{{ Lang::get('organization.name_nl') }}</dt>
    <dd>{{ $record->name_nl }}</dd>
	<dt>{{ Lang::get('organization.registration_num') }}</dt>
    <dd>{{ $record->registration_num }}</dd>
	<dt>{{ Lang::get('organization.inet_domain_name') }}</dt>
    <dd>{{ $record->inet_domain_name }}</dd>
	<dt>{{ Lang::get('organization.url') }}</dt>
    <dd>{{ $record->url }}</dd>
	<dt>{{ Lang::get('organization.country_cd') }}</dt>
    <dd>{{ $record->country_cd }}</dd>
	<dt>{{ Lang::get('organization.province') }}</dt>
    <dd>{{ $record->province }}</dd>
	<dt>{{ Lang::get('organization.district') }}</dt>
    <dd>{{ $record->district }}</dd>
	<dt>{{ Lang::get('organization.address') }}</dt>
    <dd>{{ $record->address }}</dd>
	<dt>{{ Lang::get('organization.postal_code') }}</dt>
    <dd>{{ $record->postal_code }}</dd>
	<dt>{{ Lang::get('organization.catchphrase') }}</dt>
    <dd>{{ $record->catchphrase }}</dd>
	<dt>{{ Lang::get('organization.summary') }}</dt>
    <dd>{{ $record->summary }}</dd>
	<dt>{{ Lang::get('organization.description') }}</dt>
    <dd>{{ $record->description }}</dd>
	<dt>{{ Lang::get('organization.logo_img_uri') }}</dt>
    <dd>{{ $record->logo_img_uri }}</dd>
	<dt>{{ Lang::get('organization.cover_img_uri') }}</dt>
    <dd>{{ $record->cover_img_uri }}</dd>
	<dt>{{ Lang::get('organization.found_date') }}</dt>
    <dd>{{ $record->found_date }}</dd>
	<dt>{{ Lang::get('organization.transaction') }}</dt>
    <dd>{{ $record->transaction }}</dd>
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

<script>
$(document).ready(function() {
    $('.page-header').append(' <a title="Edit" href="{{ URL::to(route('organizations.edit', array($record->sid))) }}"><small><span class="glyphicon glyphicon-pencil"></span></small></a>')
} );
</script>
@show
