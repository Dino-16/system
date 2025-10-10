<div>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">Orientation Schedule</h3>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#requestRoomModal">
            <i class="bi bi-plus-circle me-2"></i>Create schedule
        </button>
    </div>


    <div class="text-center text-muted py-5">
        <i class="bi bi-inbox" style="font-size: 2rem;"></i>
        <p class="mt-2 mb-0">No plan yet.</p>
    </div>

    @include('livewire.onboarding.includes.orientation-schedule-modal')
</div>
