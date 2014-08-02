
<!-- app/views/sequence_number/show.blade.php -->

@section('content')
<div class="container">

<!-- @todo: the field to be displayed as title -->

<h1>View {{ $record->sid }}</h1>

<dl class="dl-horizontal">
	<dt>{{ Lang::get('sequence_number.uuid') }}</dt>
    <dd>{{ $record->uuid }}</dd>
	<dt>{{ Lang::get('sequence_number.domain_sid') }}</dt>
    <dd>{{ $record->domain_sid }}</dd>
	<dt>{{ Lang::get('sequence_number.domain_id') }}</dt>
    <dd>{{ $record->domain_id }}</dd>
	<dt>{{ Lang::get('sequence_number.created_by') }}</dt>
    <dd>{{ $record->created_by }}</dd>
	<dt>{{ Lang::get('sequence_number.created_dt') }}</dt>
    <dd>{{ $record->created_dt }}</dd>
	<dt>{{ Lang::get('sequence_number.updated_by') }}</dt>
    <dd>{{ $record->updated_by }}</dd>
	<dt>{{ Lang::get('sequence_number.updated_dt') }}</dt>
    <dd>{{ $record->updated_dt }}</dd>
	<dt>{{ Lang::get('sequence_number.update_counter') }}</dt>
    <dd>{{ $record->update_counter }}</dd>
	<dt>{{ Lang::get('sequence_number.lang') }}</dt>
    <dd>{{ $record->lang }}</dd>
	<dt>{{ Lang::get('sequence_number.id') }}</dt>
    <dd>{{ $record->id }}</dd>
	<dt>{{ Lang::get('sequence_number.description') }}</dt>
    <dd>{{ $record->description }}</dd>
	<dt>{{ Lang::get('sequence_number.seq') }}</dt>
    <dd>{{ $record->seq }}</dd>
</dl>

</div> <!-- container -->
@show
