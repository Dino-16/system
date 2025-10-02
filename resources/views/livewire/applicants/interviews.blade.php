<div>

    {{-- Filter Buttons --}}
    <div @class(['row', 'mb-3'])>
        <div @class(['col-md-4'])>
            <button 
                type="button" 
                @class(['btn', 'btn-default', 'shadow-sm', 'border', 'w-100']) 
                wire:click="$set('interviewStage', 'Scheduled')"
            >
                Initial
            </button>
        </div>
        <div @class(['col-md-4'])>
            <button 
                type="button" 
                @class(['btn', 'btn-default', 'shadow-sm', 'border', 'w-100']) 
                wire:click="$set('interviewStage', 'Final')"
            >
                Final
            </button>
        </div>
        <div @class(['col-md-4'])>
            <button 
                type="button" 
                @class(['btn', 'btn-default', 'shadow-sm', 'border', 'w-100']) 
                wire:click="$set('interviewStage', 'All')"
            >
                Show All
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
            <div @class(['col-12'])>
                <div @class(['alert', 'alert-info'])>
                    No candidates match the selected interview stage.
                </div>
            </div>
        @endforelse
    </div>

    {{-- Modal --}}
    @include('livewire.applicants.includes.interview-view-modal')
</div>