
<!-- app/views/custom_field/show.blade.php -->

@section('content')
<div class="container">

<!-- @todo: the field to be displayed as title -->

<h1>View {{ $record->sid }}</h1>

<dl class="dl-horizontal">
	<dt>{{ Lang::get('custom_field.domain_sid') }}</dt>
    <dd>{{ $record->domain_sid }}</dd>
	<dt>{{ Lang::get('custom_field.type') }}</dt>
    <dd>{{ $record->type }}</dd>
	<dt>{{ Lang::get('custom_field.field_name') }}</dt>
    <dd>{{ $record->field_name }}</dd>
	<dt>{{ Lang::get('custom_field.data_type') }}</dt>
    <dd>{{ $record->data_type }}</dd>
	<dt>{{ Lang::get('custom_field.value') }}</dt>
    <dd>{{ $record->value }}</dd>
</dl>

</div> <!-- container -->
@show
