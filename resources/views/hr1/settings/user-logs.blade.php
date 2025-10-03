@extends('layouts.app')

@section('page-title', 'User Login Logs')
@section('page-subtitle', 'Track and manage login history and IP actions.')
@section('breadcrumbs', 'Login Logs')

@section('content')
<section>
    <div @class('container-fluid')>

        @livewire('auth.user-logs')

    </div>
</section>
@endsection