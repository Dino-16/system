@extends('layouts.app')

@section('page-title', 'Request Room')
@section('page-subtitle', 'Create and view your facility room requests.')
@section('breadcrumbs', 'Request Room')

@section('content')
<section>
    <div class="container-fluid">
        @livewire('applicants.request-rooms')
        @include('livewire.applicants.includes.request-room-modal')
    </div>
</section>
@endsection
