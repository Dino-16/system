@extends('layouts.app')

@section('page-title', 'Shout-outs')
@section('page-subtitle', 'Celebrate wins, recognize contributions, and boost team morale.')
@section('breadcrumbs', 'Shout-outs')

@section('content')
<section>
    <div @class('container-fluid')>

        @livewire('recognition.shout-outs')

    </div>
</section>
@endsection