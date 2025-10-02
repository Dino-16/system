@extends('layouts.app')

@section('page-title', 'Travel Job-Postings')
@section('page-subtitle', 'Review and manage incoming job requisitions.')
@section('breadcrumbs', 'Open Requests')

@section('content')
<section>
    <div @class('container-fluid')>

        @livewire('recruitment.job-postings')

    </div>
@endsection