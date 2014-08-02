
<!-- app/views/comment/show.blade.php -->

@section('content')
<div class="container">

<!-- @todo: the field to be displayed as title -->

<h1>View {{ $record->sid }}</h1>

<dl class="dl-horizontal">
	<dt>{{ Lang::get('comment.uuid') }}</dt>
    <dd>{{ $record->uuid }}</dd>
	<dt>{{ Lang::get('comment.domain_sid') }}</dt>
    <dd>{{ $record->domain_sid }}</dd>
	<dt>{{ Lang::get('comment.domain_id') }}</dt>
    <dd>{{ $record->domain_id }}</dd>
	<dt>{{ Lang::get('comment.created_by') }}</dt>
    <dd>{{ $record->created_by }}</dd>
	<dt>{{ Lang::get('comment.created_dt') }}</dt>
    <dd>{{ $record->created_dt }}</dd>
	<dt>{{ Lang::get('comment.updated_by') }}</dt>
    <dd>{{ $record->updated_by }}</dd>
	<dt>{{ Lang::get('comment.updated_dt') }}</dt>
    <dd>{{ $record->updated_dt }}</dd>
	<dt>{{ Lang::get('comment.update_counter') }}</dt>
    <dd>{{ $record->update_counter }}</dd>
	<dt>{{ Lang::get('comment.lang') }}</dt>
    <dd>{{ $record->lang }}</dd>
	<dt>{{ Lang::get('comment.object_type') }}</dt>
    <dd>{{ $record->object_type }}</dd>
	<dt>{{ Lang::get('comment.object_sid') }}</dt>
    <dd>{{ $record->object_sid }}</dd>
	<dt>{{ Lang::get('comment.title') }}</dt>
    <dd>{{ $record->title }}</dd>
	<dt>{{ Lang::get('comment.content') }}</dt>
    <dd>{{ $record->content }}</dd>
	<dt>{{ Lang::get('comment.attachments') }}</dt>
    <dd>{{ $record->attachments }}</dd>
	<dt>{{ Lang::get('comment.privacy_level') }}</dt>
    <dd>{{ $record->privacy_level }}</dd>
	<dt>{{ Lang::get('comment.params_text') }}</dt>
    <dd>{{ $record->params_text }}</dd>
</dl>

</div> <!-- container -->
@show
