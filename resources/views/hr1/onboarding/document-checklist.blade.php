@extends('layouts.app')

@section('page-title', 'Document Checklist')
@section('page-subtitle', 'Track required documents for onboarding completion.')
@section('breadcrumbs', 'Checklist')

@section('content')
<section>
    <div @class('container-fluid')>

        @livewire('onboarding.document-checklist')

    </div>
</section>
@endsection