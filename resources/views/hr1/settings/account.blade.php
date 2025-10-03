@extends('layouts.app')

@section('page-title', 'Account Settings')
@section('page-subtitle', 'Manage your profile and security.')
@section('breadcrumbs', 'Account')

@section('content')
<section>
    <div @class('container-fluid')>
        @livewire('auth.change-password')
    </div>
</section>
@endsection
