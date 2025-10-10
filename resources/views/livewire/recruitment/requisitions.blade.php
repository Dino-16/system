{{-- job requisition --}}
<div @class('pt-2')>

    {{-- Card --}}
    <div @class('mb-3')>
        @include('livewire.recruitment.includes.card-requisition')    
    </div>

    <div @class('d-flex justify-content-between align-items-center')>

        {{-- Search Bar --}}
        <div @class('mb-3 w-25')>
            <x-text-input type="search" wire:model.live.debounce.3s="search" placeholder="Search..." />
        </div>

        {{-- Filter Dropdown --}}
        <div @class('dropdown')>
            <button type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false"
                @class('btn btn-outline-body-tertiary dropdown-toggle d-flex align-items-center border rounded bg-white')>
                <i @class('bi bi-funnel-fill me-2')></i>Filter: {{ ucfirst($statusFilter) }}
            </button>
            <ul @class('dropdown-menu') aria-labelledby="filterDropdown">
                <li>
                    <a @class('dropdown-item') wire:click="$set('statusFilter', 'All')">
                        <i @class('bi bi-list-ul me-2')></i> All
                    </a>
                </li>
                <li>
                    <a @class('dropdown-item') wire:click="$set('statusFilter', 'Open')">
                        <i @class('bi bi-folder2-open me-2')></i> Open
                    </a>
                </li>
                <li>
                    <a @class('dropdown-item') wire:click="$set('statusFilter', 'In-Progress')">
                        <i @class('bi bi-hourglass-split me-2')></i> In-Progress
                    </a>
                </li>
                <li>
                    <a @class('dropdown-item') wire:click="$set('statusFilter', 'Draft')">
                        <i @class('bi bi-journal-text me-2')></i> Draft
                    </a>
                </li>
                <li>
                    <a @class('dropdown-item') wire:click="$set('statusFilter', 'Closed')">
                        <i @class('bi bi-check-circle me-2')></i> Closed
                    </a>
                </li>
            </ul>
        </div>

    </div>

    {{-- Table Title --}}
    <div @class('p-5 bg-white rounded border rounded-bottom-0 border-bottom-0')>
        <div>
            <h3>All Requisition</h3>
            <p @class('text-secondary mb-0')>
                Overview of open, draft, closed requisitions
            </p>
        </div>
    </div>

    {{-- Table --}}
    <div @class('table-responsive border rounded bg-white px-5 rounded-top-0 border-top-0')>
        <table @class('table')>
            <thead>
                <tr @class('bg-dark')>
                    <th @class('text-secondary fw-normal') scope="col">Requested by</th>
                    <th @class('text-secondary fw-normal') scope="col">Requisition</th>
                    <th @class('text-secondary fw-normal') scope="col">Department</th>
                    <th @class('text-secondary fw-normal') scope="col">Opening</th>
                    <th @class('text-secondary fw-normal') scope="col">Status</th>
                    <th @class('text-secondary fw-normal') scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($requisitions as $requisition)
                    <tr>
                        <td @class('text-nowrap')>{{ $requisition->requested_by }}</td>
                        <td @class('text-truncate')>{{ $requisition->requisition_title }}</td>
                        <td @class('text-capitalize')>{{ $requisition->department }}</td>
                        <td @class('text-start')>{{ $requisition->opening }}</td>
                        <td>
                            <span 
                                @class([
                                    'badge rounded-pill px-3 py-2',
                                    'bg-primary' => $requisition->status === 'Open',
                                    'bg-warning text-dark' => $requisition->status === 'In-Progress',
                                    'bg-danger' => $requisition->status === 'Draft',
                                    'bg-secondary' => $requisition->status === 'Closed',
                                ])
                            >
                                {{ ucfirst($requisition->status) }}
                            </span>
                        </td>
                        <td @class('text-nowrap')>

                            <button 
                                type="button" 
                                @class('btn btn-default border btn-sm') 
                                wire:click="viewRequisition({{ $requisition->id }})"
                                title="View"
                            >
                                <i @class('bi bi-eye')></i>
                            </button>
                            @if($requisition->status == "Draft" || $requisition->status == "Closed")
                                <button 
                                    type="button" 
                                    @class('btn btn-outline-secondary border btn-sm') 
                                    wire:click="draft({{ $requisition->id }})"
                                    title="Draft"
                                    disabled
                                >
                                    <i @class('bi bi-journal-text')></i>
                                </button>
                            @else 
                                <button 
                                    type="button" 
                                    @class('btn btn-default border btn-sm') 
                                    wire:click="draft({{ $requisition->id }})"
                                    title="Draft"
                                >
                                    <i @class('bi bi-journal-text')></i>
                                </button>
                            @endif
                            @if($requisition->status == "Closed")
                                <button 
                                    type="button" 
                                    @class('btn btn-outline-secondary border btn-sm') 
                                    wire:click="close({{ $requisition->id }})"
                                    title="Close"
                                    disabled
                                >
                                    <i @class('bi bi-check-circle')></i>
                                </button>
                            @else
                                <button 
                                    type="button" 
                                    @class('btn btn-default border btn-sm') 
                                    wire:click="close({{ $requisition->id }})"
                                    title="Close"
                                >
                                    <i @class('bi bi-check-circle')></i>
                                </button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" @class('text-center text-muted')>No requisitions found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        <div>
            {{ $requisitions->links() }}
        </div>

    </div>

    {{-- View Modal --}}
    @include('livewire.recruitment.includes.requisition-view-modal')    

    {{-- Draft Confirmation Modal --}}
    @include('livewire.recruitment.includes.requisition-draft-modal')  
    
    {{-- Close Confirmation Modal --}}
    @include('livewire.recruitment.includes.requisition-close-modal')    

</div>