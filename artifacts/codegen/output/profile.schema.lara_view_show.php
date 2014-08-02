
<!-- app/views/user/show.blade.php -->

@section('content')
<div class="container">

<!-- @todo: the field to be displayed as title -->

<h1>View {{ $record->sid }}</h1>

<dl class="dl-horizontal">
	<dt>{{ Lang::get('user.uuid') }}</dt>
    <dd>{{ $record->uuid }}</dd>
	<dt>{{ Lang::get('user.domain_sid') }}</dt>
    <dd>{{ $record->domain_sid }}</dd>
	<dt>{{ Lang::get('user.domain_id') }}</dt>
    <dd>{{ $record->domain_id }}</dd>
	<dt>{{ Lang::get('user.created_by') }}</dt>
    <dd>{{ $record->created_by }}</dd>
	<dt>{{ Lang::get('user.created_dt') }}</dt>
    <dd>{{ $record->created_dt }}</dd>
	<dt>{{ Lang::get('user.updated_by') }}</dt>
    <dd>{{ $record->updated_by }}</dd>
	<dt>{{ Lang::get('user.updated_dt') }}</dt>
    <dd>{{ $record->updated_dt }}</dd>
	<dt>{{ Lang::get('user.update_counter') }}</dt>
    <dd>{{ $record->update_counter }}</dd>
	<dt>{{ Lang::get('user.lang') }}</dt>
    <dd>{{ $record->lang }}</dd>
	<dt>{{ Lang::get('user.user_sid') }}</dt>
    <dd>{{ $record->user_sid }}</dd>
	<dt>{{ Lang::get('user.first_name') }}</dt>
    <dd>{{ $record->first_name }}</dd>
	<dt>{{ Lang::get('user.middle_name') }}</dt>
    <dd>{{ $record->middle_name }}</dd>
	<dt>{{ Lang::get('user.last_name') }}</dt>
    <dd>{{ $record->last_name }}</dd>
	<dt>{{ Lang::get('user.lc_name') }}</dt>
    <dd>{{ $record->lc_name }}</dd>
	<dt>{{ Lang::get('user.alt_name') }}</dt>
    <dd>{{ $record->alt_name }}</dd>
	<dt>{{ Lang::get('user.primary_lang') }}</dt>
    <dd>{{ $record->primary_lang }}</dd>
	<dt>{{ Lang::get('user.nationality_cd') }}</dt>
    <dd>{{ $record->nationality_cd }}</dd>
	<dt>{{ Lang::get('user.hometown') }}</dt>
    <dd>{{ $record->hometown }}</dd>
	<dt>{{ Lang::get('user.gender') }}</dt>
    <dd>{{ $record->gender }}</dd>
	<dt>{{ Lang::get('user.dob') }}</dt>
    <dd>{{ $record->dob }}</dd>
	<dt>{{ Lang::get('user.education_level') }}</dt>
    <dd>{{ $record->education_level }}</dd>
	<dt>{{ Lang::get('user.highlight') }}</dt>
    <dd>{{ $record->highlight }}</dd>
	<dt>{{ Lang::get('user.philosophy') }}</dt>
    <dd>{{ $record->philosophy }}</dd>
	<dt>{{ Lang::get('user.goals') }}</dt>
    <dd>{{ $record->goals }}</dd>
	<dt>{{ Lang::get('user.personality_type') }}</dt>
    <dd>{{ $record->personality_type }}</dd>
	<dt>{{ Lang::get('user.location') }}</dt>
    <dd>{{ $record->location }}</dd>
	<dt>{{ Lang::get('user.country_cd') }}</dt>
    <dd>{{ $record->country_cd }}</dd>
	<dt>{{ Lang::get('user.province_cd') }}</dt>
    <dd>{{ $record->province_cd }}</dd>
	<dt>{{ Lang::get('user.district') }}</dt>
    <dd>{{ $record->district }}</dd>
	<dt>{{ Lang::get('user.address') }}</dt>
    <dd>{{ $record->address }}</dd>
	<dt>{{ Lang::get('user.postal_code') }}</dt>
    <dd>{{ $record->postal_code }}</dd>
	<dt>{{ Lang::get('user.privacy_level') }}</dt>
    <dd>{{ $record->privacy_level }}</dd>
	<dt>{{ Lang::get('user.activity_index') }}</dt>
    <dd>{{ $record->activity_index }}</dd>
	<dt>{{ Lang::get('user.params_text') }}</dt>
    <dd>{{ $record->params_text }}</dd>
</dl>

</div> <!-- container -->
@show
