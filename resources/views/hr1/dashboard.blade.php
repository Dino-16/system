@extends('layouts.app')

@section('page-title', 'Dashboard')
@section('page-subtitle', 'Track, manage, and optimize job requisitions across teams.')
@section('breadcrumbs', 'Dashboard')


@section('content')
<section>
    <div @class('container-fluid')>

        @livewire('dashboard')

    </div>
@endsection