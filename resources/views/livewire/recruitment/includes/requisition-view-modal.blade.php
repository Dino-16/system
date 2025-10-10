@if($showModal)
    <div 
        @class('modal fade show d-block') 
        tabindex="-1" 
        style="background: rgba(0,0,0,0.5);"
    >
        <div @class('modal-dialog modal-xl modal-dialog-centered')>
            <div @class('modal-content border-0 shadow rounded-2')>

                {{-- Header --}}
                <div @class('modal-header bg-primary text-white')>
                    <h5 @class('modal-title fw-semibold')>
                        <i @class('bi bi-briefcase-fill me-2')></i>
                        Requisition Details
                    </h5>
                    <button 
                        type="button" 
                        @class('btn-close btn-close-white') 
                        wire:click="closeModal"
                    ></button>
                </div>

                {{-- Body --}}
                <div @class('modal-body')>
                    @if($selectedRequisition)
                        <div @class('row mb-3')>
                            <div @class('col-md-6')>
                                <small @class('text-uppercase text-muted')>Requested By</small>
                                <div @class('fw-bold')>{{ $selectedRequisition->requested_by }}</div>
                            </div>
                            <div @class('col-md-6')>
                                <small @class('text-uppercase text-muted')>Department</small>
                                <div @class('fw-bold')>{{ $selectedRequisition->department }}</div>
                            </div>
                        </div>

                        <div @class('row mb-3')>
                            <div @class('col-md-6')>
                                <small @class('text-uppercase text-muted')>Requisition</small>
                                <div @class('fw-bold')>{{ $selectedRequisition->requisition_title }}</div>
                            </div>
                            <div @class('col-md-6')>
                                <small @class('text-uppercase text-muted')>Openings</small>
                                <div @class('fw-bold')>{{ $selectedRequisition->opening }}</div>
                            </div>
                        </div>

                        <div @class('mb-3')>
                            <small @class('text-uppercase text-muted')>Description</small>
                            <p @class('mb-0')>{{ $selectedRequisition->requisition_description }}</p>
                        </div>

                        <div @class('row mb-3')>
                            <div @class('col-md-6')>
                                <small @class('text-uppercase text-muted')>Type</small>
                                <div @class('fw-bold')>{{ $selectedRequisition->requisition_type }}</div>
                            </div>
                            <div @class('col-md-6')>
                                <small @class('text-uppercase text-muted')>Arrangement</small>
                                <div @class('fw-bold')>{{ $selectedRequisition->requisition_arrangement }}</div>
                            </div>
                        </div>

                        <div @class('mb-3')>
                            <small @class('text-uppercase text-muted')>Responsibilities</small>
                            <p @class('mb-0')>{{ $selectedRequisition->requisition_responsibilities }}</p>
                        </div>

                        <div @class('mb-3')>
                            <small @class('text-uppercase text-muted')>Qualifications</small>
                            <p @class('mb-0')>{{ $selectedRequisition->requisition_qualifications }}</p>
                        </div>

                        <div @class('mb-3')>
                            <small @class('text-uppercase text-muted')>Status</small>
                            <span 
                                @class([
                                    'badge rounded-pill px-3 py-2',
                                    'bg-primary' => $selectedRequisition->status === 'Open',
                                    'bg-warning text-dark' => $selectedRequisition->status === 'In-Progress',
                                    'bg-danger' => $selectedRequisition->status === 'Draft',
                                    'bg-secondary' => $selectedRequisition->status === 'Closed',
                                ])
                            >
                                {{ ucfirst($selectedRequisition->status) }}
                            </span>
                        </div>
                    @else
                        <div @class('text-center text-muted py-4')>
                            No requisition selected.
                        </div>
                    @endif
                </div>

                {{-- Footer --}}
                <div @class('modal-footer bg-light border-0')>
                    <button 
                        type="button" 
                        @class('btn btn-secondary px-4') 
                        wire:click="closeModal"
                    >
                        Back
                    </button>
                </div>
            </div>
        </div>
    </div>
@endif
