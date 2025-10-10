<div>

    <div class="d-flex justify-content-end mb-3">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#requestRoomModal">
            <i class="bi bi-plus-circle me-2"></i>Request Room
        </button>
    </div>

    {{-- Interview Stage Filter Row --}}
{{-- Interview Stage Filter Row --}}
<div class="row mb-3">
    <div class="col-md-4">
        <button type="button"
            wire:click="$set('interviewStage', 'Scheduled')"
            class="btn w-100 d-flex align-items-center justify-content-center
                @if($interviewStage === 'Scheduled') btn-primary
                @else btn-outline-secondary @endif">
            <i class="bi bi-calendar-check-fill me-2"></i> Initial
        </button>
    </div>
    <div class="col-md-4">
        <button type="button"
            wire:click="$set('interviewStage', 'Final')"
            class="btn w-100 d-flex align-items-center justify-content-center
                @if($interviewStage === 'Final') btn-primary
                @else btn-outline-secondary @endif">
            <i class="bi bi-person-check-fill me-2"></i> Final
        </button>
    </div>
    <div class="col-md-4">
        <button type="button"
            wire:click="$set('interviewStage', 'All')"
            class="btn w-100 d-flex align-items-center justify-content-center
                @if($interviewStage === 'All') btn-primary
                @else btn-outline-secondary @endif">
            <i class="bi bi-list-ul me-2"></i> Show All
        </button>
    </div>
</div>

    <div @class(['row'])>
        @forelse($candidates as $candidate)
            <div @class(['col-md-3'])>
                <div @class(['card', 'shadow-sm', 'border-0', 'p-3', 'h-100'])>
                    <div @class(['card-body'])>
                        <h5 @class(['card-title', 'fw-bold'])>
                            {{ ucwords($candidate->candidate_first_name . ' ' . $candidate->candidate_last_name) }}
                        </h5>
                        <p @class(['mb-2'])>
                            <strong>Skills:</strong> {{ $candidate->skills }}
                        </p>
                        <div @class(['d-flex', 'gap-2'])>
                            <button 
                                @class(['btn', 'btn-outline-secondary', 'btn-sm']) 
                                wire:click="viewCandidate({{ $candidate->id }})"
                            >
                                View
                            </button>

                            @if($candidate->status === 'Scheduled' || $candidate->status === 'Initial')
                                {{-- Initial stage --}}
                                <button 
                                    @class(['btn', 'btn-success', 'btn-sm']) 
                                    wire:click="final({{ $candidate->id }})"
                                >
                                    Proceed Final
                                </button>
                                <button 
                                    @class(['btn', 'btn-danger', 'btn-sm']) 
                                    wire:click="reject({{ $candidate->id }})"
                                >
                                    Reject
                                </button>

                            @elseif($candidate->status === 'Final')
                                {{-- Final stage --}}
                                <button 
                                    @class(['btn', 'btn-primary', 'btn-sm']) 
                                    wire:click="approve({{ $candidate->id }})"
                                >
                                    Approve
                                </button>
                                <button 
                                    @class(['btn', 'btn-danger', 'btn-sm']) 
                                    wire:click="reject({{ $candidate->id }})"
                                >
                                    Reject
                                </button>

                            @elseif($candidate->status === 'Passed')
                                {{-- Approved stage --}}
                                <button 
                                    @class(['btn', 'btn-success', 'btn-sm']) 
                                    disabled
                                >
                                    Done
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="d-flex justify-content-center align-items-center w-100 py-5" style="min-height: 200px;">
                <span class="text-muted fs-5">No candidates in this category.</span>
            </div>
        @endforelse
    </div>

    {{-- Modals --}}
    @include('livewire.applicants.includes.interview-view-modal')
    @include('livewire.applicants.includes.request-room-modal')
</div>