{{-- Jobs --}}
<div @class('pt-3')>

    <x-alert-success />

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
                        <i @class('bi bi-hourglass-split me-2')></i> Open
                    </a>
                </li>
                <li>
                    <a @class('dropdown-item') wire:click="$set('statusFilter', 'Posted')">
                        <i @class('bi bi-send-check me-2')></i> Posted
                    </a>
                </li>
                <li>
                    <a @class('dropdown-item') wire:click="$set('statusFilter', 'Removed')">
                        <i @class('bi bi-trash-fill me-2')></i> Removed
                    </a>
                </li>
            </ul>
        </div>
 
    </div>

    {{-- Table Title --}}
    <div @class('p-5 bg-white rounded border rounded-bottom-0 border-bottom-0')>
        <div>
            <h3>All Jobs</h3>
            <p @class('text-secondary mb-0')>
                Overview of all open and posted jobs
            </p>
        </div>
    </div>

    {{-- Table --}}
    <div @class('table-responsive border rounded bg-white px-5 rounded-top-0 border-top-0')>
        <table @class('table')>
            <thead>
                <tr @class('bg-dark')>
                    <th @class('text-secondary fw-normal') scope="col">Jobs</th>
                    <th @class('text-secondary fw-normal') scope="col">Requisition ID</th>
                    <th @class('text-secondary fw-normal') scope="col">Open Date</th>
                    <th @class('text-secondary fw-normal') scope="col">Posted Date</th>
                    <th @class('text-secondary fw-normal') scope="col">Status</th>
                    <th @class('text-secondary fw-normal') scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($combinedItems as $item)
                    <tr>
                        <td @class('w-25')>
                            <p @class('mb-2')><strong>Title:</strong><br>{{ $item['title'] }}</p>
                            <p @class('mb-2')><strong>Description:</strong><br>{{ $item['description'] }}</p>
                            <p @class('mb-2')><strong>Responsibility:</strong><br>{{ $item['responsibility'] }}</p>
                            <p @class('mb-2')><strong>Qualification:</strong><br>{{ $item['qualification'] }}</p>
                        </td>
                        <td @class('text-nowrap')>{{ "REQ-" . $item['requisition_id'] }}</td>
                        <td @class('text-nowrap')>{{ $item['created_at']->format('M d, Y') }}</td>
                        <td @class('text-nowrap')>
                            @if($item['source'] === 'job')
                                <span title="Posted Job">{{ $item['created_at']->format('M d, Y') }}</span>
                            @else
                                <span>Not Posted</span>
                            @endif
                        </td>
                        <td>
                            <span 
                                @class([
                                    'badge rounded-pill px-3 py-2',
                                    'bg-primary' => $item['status'] === 'Open',
                                    'bg-success' => $item['status'] === 'Posted',
                                    'bg-secondary' => $item['status'] === 'Removed',
                                ])
                            >
                                {{ ucfirst($item['status']) }}
                            </span>
                        </td>
                        <td @class('text-nowrap')>
                            @if($item['status']  == 'Open')
                                <button type="button" 
                                    class="btn btn-default border btn-sm" 
                                    wire:click="postJob({{ $item['requisition_id'] }})"
                                    title="Post">
                                        <i class="bi bi-send"></i>
                                </button>
                            @endif

                            @if($item['status']  == 'Posted')
                                <button type="button" 
                                    class="btn btn-default border btn-sm" 
                                    wire:click="updateJob({{ $item['id'] }})"
                                    title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                </button>
                        
                                <button type="button" 
                                    class="btn btn-default border btn-sm"
                                    wire:click="removeJob({{ $item['id'] }})"
                                    title="Remove">
                                        <i class="bi bi-trash3"></i>
                                </button>
                            @endif

                            @if($item['status']  == 'Removed')
                                <button type="button" 
                                    class="btn btn-default border btn-sm"
                                    wire:click="restoreJob({{ $item['id'] }})"
                                    title="Restore">
                                        <i class="bi bi-bootstrap-reboot"></i>
                                </button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" @class('text-center text-muted')>No Records Found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        <div>
           {{ $combinedItems->links() }}
        </div>

    </div>

    {{-- Update Modal --}} 
    @include('livewire.recruitment.includes.posting-update-modal') 

    {{-- Remove Modal --}} 
    @include('livewire.recruitment.includes.posting-remove-modal') 

</div>