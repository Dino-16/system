@extends('layouts.app')

@section('page-title', 'Evaluation Form')
@section('page-subtitle', 'Fill out and submit employee performance evaluations.')
@section('breadcrumbs', 'Evaluation Form')

@section('content')
<section>
    <div @class('container-fluid')>

        @livewire('performance.evaluation-form')

    </div>
</section>
@endsection