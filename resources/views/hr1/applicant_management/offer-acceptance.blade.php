@extends('layouts.app')

@section('page-title', 'Offer Acceptance')
@section('page-subtitle', 'Track and manage applicant responses to job offers.')
@section('breadcrumbs', 'Offer Acceptance')

@section('content')
<section>
    <div @class('container-fluid')>

        @livewire('applicants.offer-acceptance')

    </div>
</section>
@endsection