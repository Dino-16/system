<div class="py-4">

    <div class="row justify-content-center">
        <div class="col-12 col-lg-12 col-xxl-12">
            <div class="card border-0 shadow-sm rounded-3 mb-4">
                <div class="card-header bg-white border-0 pt-4 pb-2">
                    <h5 class="mb-1 fw-semibold d-flex align-items-center gap-2">
                        <i class="bi bi-folder2-open text-primary"></i>
                        New Hire Document Checklist
                    </h5>
                    <p class="text-muted mb-0 small">Use this checklist to track required submissions for onboarding.</p>
                </div>

                <div class="card-body pt-0">
                    {{-- Success Alert --}}
                    @if (session()->has('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    {{-- New Hire Name --}}
                    <div class="mb-3">
                        <label for="new_hire_name" class="form-label fw-semibold">New Hire Name</label>
                        <select class="form-select shadow-sm" id="new_hire_name" wire:model="newHireName">
                            <option value="">Select a new hire</option>
                            @foreach ($newHireList as $hire)
                                <option value="{{ $hire['name'] }}">{{ $hire['name'] }}</option>
                            @endforeach
                        </select>
                        @error('newHireName') 
                            <span class="text-danger">{{ $message }}</span> 
                        @enderror
                    </div>

                    {{-- Document Checklist (responsive table) --}}
                    <div class="table-responsive mb-3">
                        <table class="table table-striped table-hover align-middle mb-0 border w-100">
                            <thead class="table-light">
                                <tr>
                                    <th style="width:6rem" class="text-center">#</th>
                                    <th class="fw-semibold" style="width:70%">Document</th>
                                    <th class="text-center fw-semibold" style="width:24%">Submitted</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ([
                                    ['label' => 'Resume', 'field' => 'resume'],
                                    ['label' => 'Medical Certificate', 'field' => 'medical_certificate'],
                                    ['label' => 'Valid Government ID', 'field' => 'valid_government_id'],
                                    ['label' => 'Transcript of Records', 'field' => 'transcript_of_records'],
                                    ['label' => 'NBI Clearance', 'field' => 'nbi_clearance'],
                                    ['label' => 'Barangay Clearance', 'field' => 'barangay_clearance'],
                                ] as $index => $doc)
                                    <tr>
                                        <td class="text-center py-3">
                                            <span class="badge bg-light text-dark border fw-normal">{{ $index + 1 }}</span>
                                        </td>
                                        <td class="fw-normal py-3">{{ $doc['label'] }}</td>
                                        <td class="text-center py-3">
                                            <input type="checkbox" class="form-check-input"
                                                   wire:model.defer="{{ $doc['field'] }}"
                                                   id="{{ $doc['field'] }}">
                                        </td>
                                    </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Save Button --}}
                    <div class="mt-3">
                        <button wire:click="saveChecklist" class="btn btn-primary w-100 shadow-sm rounded-3">
                            <i class="bi bi-save me-1"></i> Save Checklist
                        </button>
                    </div>
                </div>
            </div>
    </div>

    {{-- === SUBMITTED CHECKLISTS TABLE === --}}
    <div class="pt-3">
        {{-- Search Bar --}}
        <div class="mb-3 w-25">
            <x-text-input type="search" wire:model.live.debounce.300ms="search" placeholder="Search by new hire name..." />
        </div>

        {{-- Table Header --}}
        <div class="p-4 bg-white rounded border border-bottom-0">
            <h4 class="mb-1 d-flex align-items-center gap-2"><i class="bi bi-journal-check text-primary"></i> Submitted Document Checklists</h4>
            <p class="text-secondary mb-0 small">Overview of onboarding document submissions</p>
        </div>

        {{-- Table Content --}}
        <div class="table-responsive border rounded bg-white px-3 px-md-4 px-lg-5 rounded-top-0 border-top-0">
            <table class="table table-striped align-middle mb-0">
                <thead class="bg-dark">
                    <tr>
                        <th class="text-secondary fw-normal">#</th>
                        <th class="text-secondary fw-normal">New Hire</th>
                        <th class="text-secondary fw-normal">Submitted Documents</th>
                        <th class="text-secondary fw-normal text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($checklists as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->new_hire_name }}</td>
                            <td>
                                <ul class="list-unstyled mb-0">
                                    @foreach ([
                                        'resume' => 'Resume',
                                        'signed_application_form' => 'Signed Application Form',
                                        'valid_government_id' => 'Valid Government ID',
                                        'transcript_of_records' => 'Transcript of Records',
                                        'medical_certificate' => 'Medical Certificate',
                                        'nbi_clearance' => 'NBI Clearance',
                                        'barangay_clearance' => 'Barangay Clearance',
                                    ] as $field => $label)
                                        @if ($item->$field)
                                            <li>
                                                <i class="bi bi-check-circle-fill text-success me-1"></i>
                                                {{ $label }}
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </td>
                            <td class="text-center">
                                @php
                                    $total = 7;
                                    $submitted = collect([
                                        $item->resume,
                                        $item->signed_application_form,
                                        $item->valid_government_id,
                                        $item->transcript_of_records,
                                        $item->medical_certificate,
                                        $item->nbi_clearance,
                                        $item->barangay_clearance,
                                    ])->filter()->count();
                                @endphp

                                <span 
                                    class="badge rounded-pill px-3 py-2 
                                        {{ $submitted === $total ? 'bg-success' : 'bg-warning text-dark' }}">
                                    {{ $submitted === $total ? 'Complete' : 'Incomplete' }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">No checklists found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
