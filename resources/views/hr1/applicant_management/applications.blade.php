@extends('layouts.app')

@section('page-title', 'Travel Applicants')
@section('page-subtitle', 'Review and manage applicants.')
@section('breadcrumbs', 'Applicants')

@section('content')
<section>
    <div @class('container-fluid')>

        @livewire('applicants.applications')

    </div>
@endsection