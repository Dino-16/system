@extends('layouts.app')

@section('page-title', 'Travel Job-Requisition')
@section('page-subtitle', 'Review and manage incoming job requisitions.')
@section('breadcrumbs', 'Open Requests')

@section('content')

<section>
    <div @class(['container-fluid'])>

    @livewire('recruitment.requisitions')
    
    </div>
</section>

@endsection