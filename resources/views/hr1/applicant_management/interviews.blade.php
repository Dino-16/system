@extends('layouts.app')

@section('page-title', 'Interview Candidates')
@section('page-subtitle', 'Review and manage candidates scheduled for interviews.')
@section('breadcrumbs', 'Interviews')

@section('content')
<section>
    <div @class('container-fluid')>

        @livewire('applicants.interviews')

    </div>
</section>
@endsection