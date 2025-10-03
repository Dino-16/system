<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card border rounded shadow-sm mb-4">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0">📁 New Hire Document Checklist</h5>
                    <p class="text-muted mb-0">Use this checklist to track required submissions for onboarding</p>
                </div>

                <div class="card-body">
                    @if (session()->has('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    {{-- New Hire Name --}}
                    <div class="mb-4">
                        <label for="new_hire_name" class="form-label fw-bold">New Hire Name</label>
                        <input type="text" class="form-control" id="new_hire_name" wire:model.defer="newHireName" placeholder="e.g. Juan Dela Cruz">
                        @error('newHireName') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    {{-- Table Checklist --}}
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Document</th>
                                    <th class="text-center">Submitted</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ([
                                    ['label' => 'Resume', 'field' => 'resume'],
                                    ['label' => 'Signed Application Form', 'field' => 'signed_application_form'],
                                    ['label' => 'Valid Government ID', 'field' => 'valid_government_id'],
                                    ['label' => 'Transcript of Records', 'field' => 'transcript_of_records'],
                                    ['label' => 'Medical Certificate', 'field' => 'medical_certificate'],
                                    ['label' => 'NBI Clearance', 'field' => 'nbi_clearance'],
                                    ['label' => 'Barangay Clearance', 'field' => 'barangay_clearance'],
                                    ['label' => 'Signed Job Offer / Contract', 'field' => 'signed_job_offer_contract'],
                                ] as $index => $doc)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $doc['label'] }}</td>
                                        <td class="text-center">
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
                    <div class="mt-4">
                        <button wire:click="saveChecklist" class="btn btn-primary w-100">
                            Save Checklist
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="pt-3">
        <div class="p-5 bg-white rounded border rounded-bottom-0 border-bottom-0">
            <div>
                <h3>📄 Submitted Document Checklists</h3>
                <p class="text-secondary mb-0">Overview of onboarding document submissions</p>
            </div>
        </div>

        <div class="table-responsive border rounded bg-white px-5 rounded-top-0 border-top-0">
            <table class="table">
                <thead class="bg-dark">
                    <tr>
                        <th class="text-secondary fw-normal">#</th>
                        <th class="text-secondary fw-normal">New Hire</th>
                        <th class="text-secondary fw-normal">Submitted Documents</th>
                        <th class="text-secondary fw-normal">Status</th>
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
                                        'signed_job_offer_contract' => 'Signed Job Offer / Contract',
                                    ] as $field => $label)
                                        @if ($item->$field)
                                            <li><i class="bi bi-check-circle-fill text-success me-1"></i>{{ $label }}</li>
                                        @endif
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                                @php
                                    $total = 8;
                                    $submitted = collect([
                                        $item->resume,
                                        $item->signed_application_form,
                                        $item->valid_government_id,
                                        $item->transcript_of_records,
                                        $item->medical_certificate,
                                        $item->nbi_clearance,
                                        $item->barangay_clearance,
                                        $item->signed_job_offer_contract,
                                    ])->filter()->count();
                                @endphp
                                <span class="badge {{ $submitted === $total ? 'bg-success' : 'bg-warning text-dark' }}">
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