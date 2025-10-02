@extends('layouts.app')

@section('page-title', 'Shout-out Records')
@section('page-subtitle', 'Celebrate wins, recognize contributions, and boost team morale.')
@section('breadcrumbs', 'Shout-out Records')

@section('content')
<section>
    <div class="container-fluid">
        @livewire('recognition.shoutout-records')
    </div>
</section>
@endsection