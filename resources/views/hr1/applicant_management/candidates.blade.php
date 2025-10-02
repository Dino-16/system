@extends('layouts.app')

@section('page-title', 'Travel Candidates')
@section('page-subtitle', 'Review and manage shortlisted candidates.')
@section('breadcrumbs', 'Candidates')

@section('content')
<section>
    <div @class('container-fluid')>

        @livewire('applicants.candidates')

    </div>
</section>
@endsection