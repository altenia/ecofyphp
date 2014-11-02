<?php use Altenia\Ecofy\Module\Security\AccessControl; ?>
<!-- app/views/persons/show.blade.php -->

@section('content')
<div class="container">

<!-- @todo - the field to be displayed as title -->

<dl class="dl-horizontal">
    @if ($accessControl->check(AccessControl::FLAG_ADMIN, 'svc:person'))
    <dt>{{ Lang::get('common.created_dt') }}</dt>
    <dd>{{ $record->created_dt }}</dd>
    <dt>{{ Lang::get('common.updated_dt') }}</dt>
    <dd>{{ $record->updated_dt }}</dd>
    <dt>{{ Lang::get('common.updated_by') }}</dt>
    <dd title="{{ $record->updated_by }}">{{ $record->updated_by_name }}</dd>
    <dt>{{ Lang::get('common.update_counter') }}</dt>
    <dd>{{ $record->update_counter }}</dd>
    <dt>{{ Lang::get('common.uuid') }}</dt>
    <dd>{{ $record->uuid }}</dd>
    @endif

    <dt>{{ Lang::get('person.id') }}</dt>
    <dd>{{ $record->id }}</dd>
    <dt>{{ Lang::get('person.name') }}</dt>
    <dd>{{ $record->getFullName2() }}</dd>
    <dt>{{ Lang::get('person.name_nl') }}</dt>
    <dd>{{ $record->name_nl }}</dd>
    <dt>{{ Lang::get('person.alternate_name') }}</dt>
    <dd>{{ $record->alternate_name }}</dd>
    <dt>{{ Lang::get('person.affiliation') }}</dt>
    <dd>{{ $record->affiliation }}</dd>

    @if ($accessControl->check(AccessControl::FLAG_UPDATE, 'svc:person'))
    <dt>{{ Lang::get('person.birth_date') }}</dt>
    <dd>{{ $record->birth_date }}</dd>
    <dt>{{ Lang::get('person.telephone') }}</dt>
    <dd>{{ $record->telephone }}</dd>
    <dt>{{ Lang::get('person.mobile_number') }}</dt>
    <dd>{{ $record->mobile_number }}</dd>
    <dt>{{ Lang::get('person.email') }}</dt>
    <dd>{{ $record->email }}</dd>

    <dt>{{ Lang::get('person.address') }}</dt>
    <dd>{{ $record->address }}</dd>
    <dt>{{ Lang::get('person.province_cd') }}</dt>
    <dd>{{ $record->province_cd }}</dd>
    <dt>{{ Lang::get('person.postal_code') }}</dt>
    <dd>{{ $record->postal_code }}</dd>
    @endif

    <dt>{{ Lang::get('person.description') }}</dt>
    <dd>{{ $record->description }}</dd>
    <dt>{{ Lang::get('person.highlight') }}</dt>
    <dd>{{ $record->highlight }}</dd>
    <dt>{{ Lang::get('person.status') }}</dt>
    <dd>{{ $record->status }}</dd>

    <dd>{{ $record->params_text }}</dd>
</dl>


@if (!empty($record->familyMembers))
    <h4>Family Members</h4>
    <table class="table table-striped table-condensed">
        <thead>
            <tr>
                <th>{{ Lang::get('person.name_nl') }}</th>
                <th>{{ Lang::get('person.alternate_name') }}</th>
                <th>{{ Lang::get('person.name') }}</th>
                <th>{{ Lang::get('person.email') }}</th>
                <th>{{ Lang::get('person.mobile_number') }}</th>
                <th>{{ Lang::get('person.status') }}</th>
                <th>{{ Lang::get('common.actions') }}</th>
            </tr>
        </thead>
        <tbody>
@foreach ($record->familyMembers as $familyMember)
            <tr <?php if ($familyMember->sid == $record->sid) echo 'class="success"'; ?> >
                <td>
                @if ($familyMember->isHeadOfFamily())
                    *
                @endif
                    {{ $familyMember->name_nl }}</td>
                <td>{{ $familyMember->alternate_name }}</td>
                <td><a href="{{ URL::to(route('persons.show', array($familyMember->sid))) }}">{{ $familyMember->getFullName() }}</a></td>
                <td>{{ $familyMember->email }}</td>
                <td>{{ $familyMember->mobile_number }}</td>
                <td>{{ $familyMember->status }}</td>
                <td><a href="{{ URL::to(route('persons.edit', array($record->sid))) }}" >Edit</a></td>
            </tr>
@endforeach
        </tbody>
    </table>
@endif
<a class="btn btn-info" href="{{ URL::to(route('persons.create', array('hof' => $record->sid))) }}" >Create new family member</a>

</div> <!-- container -->

<script>
$(document).ready(function() {
    $('.page-header').append(' <a title="Edit" href="{{ URL::to(route('persons.edit', array($record->sid))) }}"><small><span class="glyphicon glyphicon-pencil"></span></small></a>')
} );
</script>

@show