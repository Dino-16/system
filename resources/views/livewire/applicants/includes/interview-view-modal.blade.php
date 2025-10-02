@if($showModal)
<div @class(['modal', 'fade', 'show', 'd-block']) tabindex="-1" style="background: rgba(0,0,0,0.5);">
    <div @class(['modal-dialog', 'modal-xl', 'modal-dialog-centered'])>
        <div @class(['modal-content', 'border-0', 'shadow-lg', 'rounded-4'])>
            <div @class(['modal-header', 'bg-primary', 'text-white', 'rounded-top-4'])>
                <h5 @class(['modal-title'])>Candidate Profile</h5>
                <button type="button" @class(['btn-close', 'btn-close-white']) wire:click="closeModal"></button>
            </div>

            <div @class(['modal-body', 'px-5', 'py-4'])>
                @if($selectedCandidate)
                    <div @class(['row', 'g-4'])>

                        {{-- Personal Info --}}
                        <div @class(['col-12'])>
                            <h6 @class(['text-uppercase', 'text-muted', 'border-bottom', 'pb-2'])>Personal Information</h6>
                        </div>
                        <div @class(['col-md-6'])>
                            <label @class(['form-label', 'fw-bold'])>Full Name</label>
                            <div>{{ $selectedCandidate->candidate_first_name }} {{ $selectedCandidate->candidate_middle_name }} {{ $selectedCandidate->candidate_last_name }} {{ $selectedCandidate->candidate_suffix_name }}</div>
                        </div>
                        <div @class(['col-md-6'])>
                            <label @class(['form-label', 'fw-bold'])>Email</label>
                            <div>{{ $selectedCandidate->candidate_email }}</div>
                        </div>
                        <div @class(['col-md-6'])>
                            <label @class(['form-label', 'fw-bold'])>Phone</label>
                            <div>{{ $selectedCandidate->candidate_phone }}</div>
                        </div>
                        <div @class(['col-md-6'])>
                            <label @class(['form-label', 'fw-bold'])>Address</label>
                            <div>{{ $selectedCandidate->candidate_address }}</div>
                        </div>

                        {{-- Demographics --}}
                        <div @class(['col-12'])>
                            <h6 @class(['text-uppercase', 'text-muted', 'border-bottom', 'pb-2', 'mt-4'])>Demographics</h6>
                        </div>
                        <div @class(['col-md-4'])>
                            <label @class(['form-label', 'fw-bold'])>Age</label>
                            <div>{{ $selectedCandidate->candidate_age }}</div>
                        </div>
                        <div @class(['col-md-4'])>
                            <label @class(['form-label', 'fw-bold'])>Gender</label>
                            <div>{{ $selectedCandidate->candidate_gender }}</div>
                        </div>
                        <div @class(['col-md-4'])>
                            <label @class(['form-label', 'fw-bold'])>Civil Status</label>
                            <div>{{ $selectedCandidate->candidate_civil_status }}</div>
                        </div>
                        <div @class(['col-md-6'])>
                            <label @class(['form-label', 'fw-bold'])>Birth Date</label>
                            <div>{{ $selectedCandidate->candidate_birth_date }}</div>
                        </div>

                        {{-- Job Info --}}
                        <div @class(['col-12'])>
                            <h6 @class(['text-uppercase', 'text-muted', 'border-bottom', 'pb-2', 'mt-4'])>Job Details</h6>
                        </div>
                        <div @class(['col-md-6'])>
                            <label @class(['form-label', 'fw-bold'])>Applied Job</label>
                            <div>{{ $selectedCandidate->candidate_job_title }}</div>
                        </div>
                        <div @class(['col-md-6'])>
                            <label @class(['form-label', 'fw-bold'])>Job ID</label>
                            <div>{{ $selectedCandidate->applicant_job_id }}</div>
                        </div>

                        {{-- Education & Experience --}}
                        <div @class(['col-12'])>
                            <h6 @class(['text-uppercase', 'text-muted', 'border-bottom', 'pb-2', 'mt-4'])>Education & Experience</h6>
                        </div>
                        <div @class(['col-md-6'])>
                            <label @class(['form-label', 'fw-bold'])>Education</label>
                            <div>{{ $selectedCandidate->education }}</div>
                        </div>
                        <div @class(['col-md-12'])>
                            <label @class(['form-label', 'fw-bold'])>Skills</label>
                            <div>{{ $selectedCandidate->skills }}</div>
                        </div>
                        <div @class(['col-md-12'])>
                            <label @class(['form-label', 'fw-bold'])>Experience</label>
                            <div>{{ $selectedCandidate->experience }}</div>
                        </div>

                        <div @class(['col-md-6'])>
                            <label @class(['form-label', 'fw-bold'])>Status</label>
                            <div @class(['badge', 'bg-primary'])>{{ $selectedCandidate->status }}</div>
                        </div>
                    </div>
                @else
                    <div @class(['text-center', 'text-muted', 'py-4'])>
                        No candidate selected.
                    </div>
                @endif
            </div>

            <div @class(['modal-footer', 'bg-light', 'rounded-bottom-4'])>
                <button type="button" @class(['btn', 'btn-outline-secondary']) wire:click="closeModal">Close</button>
            </div>
        </div>
    </div>
</div>
@endif