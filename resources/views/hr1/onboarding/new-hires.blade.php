@extends('layouts.app')

@section('page-title', 'New Hire')
@section('page-subtitle', 'Add and manage newly onboarded employees.')
@section('breadcrumbs', 'New Hire')

@section('content')
<section>
    <div @class('container-fluid')>

        @livewire('onboarding.new-hires')

    </div>
</section>
@endsection