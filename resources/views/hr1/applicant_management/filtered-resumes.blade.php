@extends('layouts.app')

@section('page-title', 'Filtered Resumes')
@section('page-subtitle', 'Browse and manage applicant resumes based on filters.')
@section('breadcrumbs', 'Resumes')

@section('content')
<section>
    <div @class('container-fluid')>

        @livewire('applicants.filtered-resumes')

    </div>
</section>
@endsection