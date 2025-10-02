<div>

    <x-alert-success />

    <div @class('d-flex justify-content-between align-items-center')>

        {{-- Search Bar --}}
        <div @class('mb-3 w-25')>
            <x-text-input type="search" wire:model.live.debounce.3s="search" placeholder="Search..." />
        </div>

        {{-- Filter Dropdown --}}
        <div @class('dropdown')>
            <button type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false"
                @class('btn btn-outline-body-tertiary dropdown-toggle d-flex align-items-center')>
                <i @class('bi bi-funnel-fill me-2')></i>Filter: {{ ucfirst($statusFilter) }}
            </button>
            <ul @class('dropdown-menu') aria-labelledby="filterDropdown">
                <li>
                    <a @class('dropdown-item') wire:click="$set('statusFilter All')">
                        <i @class('bi bi-list-ul me-2')></i> All
                    </a>
                </li>
                <li>
                    <a @class('dropdown-item') wire:click="$set('statusFilter Pending')">
                        <i @class('bi bi-hourglass-split me-2')></i> Pending
                    </a>
                </li>
                <li>
                    <a @class('dropdown-item') wire:click="$set('statusFilter Passed')">
                        <i @class('bi bi-check-circle-fill me-2 text-success')></i> Passed
                    </a>
                </li>
                <li>
                    <a @class('dropdown-item') wire:click="$set('statusFilter Failed')">
                        <i @class('bi bi-x-circle-fill me-2 text-danger')></i> Failed
                    </a>
                </li>
            </ul>
        </div>
    
    </div>
    
    {{-- Table Title --}}
    <div @class('p-5 bg-white rounded border rounded-bottom-0 border-bottom-0')>
        <div>
            <h3>All Applicants</h3>
            <p @class('text-secondary mb-0')>Overview of all filtered and not filtered applicants</p>
        </div>
    </div>


    {{-- Table --}}
    <div @class('table-responsive border rounded bg-white px-5 rounded-top-0 border-top-0')>
        <table @class('table')>
            <thead>
                <tr @class('bg-dark')>
                    <th @class('text-secondary fw-normal') scope="col">Applicant Name</th>
                    <th @class('text-secondary fw-normal') scope="col">Applied Job</th>
                    <th @class('text-secondary fw-normal') scope="col">Email</th>
                    <th @class('text-secondary fw-normal') scope="col">Resume</th>
                    <th @class('text-secondary fw-normal') scope="col">Status</th>
                    <th @class('text-secondary fw-normal') scope="col">Application Date</th>
                    <th @class('text-secondary fw-normal') scope="col">Filter</th>
                </tr>
            </thead>
            <tbody>
                @forelse($applicants as $applicant)
                    <tr>
                        <td @class('text-nowrap')>{{ ucwords($applicant->applicant_first_name . ' ' . $applicant->applicant_last_name) }}</td>
                        <td @class('text-truncate')>{{ $applicant->job_title}}</td>
                        <td @class('text-truncate')>{{ $applicant->applicant_email}}</td>
                        <td>
                            <button 
                                @class('btn btn-default border btn-sm') 
                                data-bs-toggle="modal" 
                                data-bs-target="#resumeModal{{ $applicant->id }}"
                                title="View Resume"
                            >
                                <i class="bi bi-eye"></i>
                            </button>

                            <!-- Modal -->
                            <div 
                                @class('modal fade') 
                                id="resumeModal{{ $applicant->id }}" 
                                tabindex="-1" 
                                aria-labelledby="resumeModalLabel{{ $applicant->id }}" 
                                aria-hidden="true"
                            >
                                <div @class('modal-dialog modal-xl')>
                                    <div @class('modal-content')>
                                        <div @class('modal-header')>
                                            <h5 
                                                @class('modal-title') 
                                                id="resumeModalLabel{{ $applicant->id }}"
                                            >
                                                Resume - {{ ucwords($applicant->applicant_first_name . ' ' .  $applicant->applicant_last_name) }}
                                            </h5>
                                            <button 
                                                type="button" 
                                                @class('btn-close') 
                                                data-bs-dismiss="modal" 
                                                aria-label="Close"
                                            ></button>
                                        </div>
                                        <div 
                                            @class('modal-body') 
                                            style="height: 80vh;"
                                        >
                                            <iframe 
                                                data-src="https://careers-hr1.jetlougetravels-ph.com/api/resume/{{ $applicant->id }}" 
                                                style="width:100%;height:100%;" 
                                                frameborder="0"
                                            ></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td @class('text-capitalize')>
                            <span 
                                @class([
                                    'badge rounded-pill px-3 py-2',
                                    'bg-primary' => $applicant['status'] === 'Pending',
                                    'bg-success' => $applicant['status'] === 'Passed',
                                    'bg-secondary' => $applicant['status'] === 'Failed',
                                ])
                            >
                                {{ ucfirst($applicant['status']) }}
                            </span>
                        </td>
                        <td @class('text-start')>{{ $applicant->created_at }}</td>
                        <td @class('text-capitalize')>
                            @if($applicant->status == 'Filtered')
                                <button type="button" class="btn btn-secondary btn-sm" disabled>Done</button>
                            @else
                                <button 
                                    @class('btn btn-default border btn-sm') 
                                    title="A.I Filter">
                                    <i class="bi bi-robot"></i></button>
                                <button 
                                    wire:click="reviewResume({{ $applicant->id }})"
                                    @class('btn btn-default border btn-sm') 
                                    title="Manual Filter">
                                    <i class="bi bi-file-earmark-text"></i>
                                </button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td @class('text-center text-muted') colspan="7">
                            No Records Found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        <div>
            {{ $applicants->links() }}
        </div>

        {{-- Modal --}}
        @include('livewire.applicants.includes.applicant-review-modal') 

    </div>
</div>
