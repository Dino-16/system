@extends('layouts.app')

@section('page-title', 'New Hires Review')
@section('page-subtitle', 'Assess and manage recently onboarded employees.')
@section('breadcrumbs', 'New Hires')

@section('content')
<section>
    <div @class('container-fluid')>

        @livewire('performance.new-hire-review')

    </div>
</section>
@endsection