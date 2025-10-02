@extends('layouts.app')

@section('page-title', 'Employee Evaluations')
@section('page-subtitle', 'Review and manage employee performance evaluations.')
@section('breadcrumbs', 'Evaluations')

@section('content')
<section>
    <div @class('container-fluid')>

        @livewire('performance.employee-evaluations')

    </div>
</section>
@endsection