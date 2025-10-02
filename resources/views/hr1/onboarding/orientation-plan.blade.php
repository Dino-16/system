@extends('layouts.app')

@section('page-title', 'Orientation Plan')
@section('page-subtitle', 'Schedule and manage onboarding orientation activities.')
@section('breadcrumbs', 'Orientation')

@section('content')
<section>
    <div @class('container-fluid')>

        @livewire('onboarding.orientation-plan')

    </div>
</section>
@endsection