<div>
    @if (session('failed'))
        <div wire:init="$dispatch('refreshFailed')" class="alert alert-danger">
            {{ session('failed') }}
        </div>
    @endif
</div>
