@if($showUpdateModal && $selectedJob)
<div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            
            {{-- Header --}}
            <div class="modal-header bg-primary text-white">
                <i @class('bi bi-briefcase-fill me-2')></i>
                <h5 class="modal-title">Posting Details</h5>
                <button type="button" class="btn-close btn-close-white" wire:click="closeUpdateModal"></button>
            </div>

            {{-- Body --}}
            <div class="modal-body">
                <form wire:submit.prevent="postUpdate">

                    {{-- Title --}}
                    <div class="mb-5">
                        <h2>Edit Job</h2>
                        <p>Basic details about the job.</p>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="row">
                        {{-- Job Title --}}
                        <div class="col-md-6 mb-3">
                            <label for="job-title" class="form-label">Job Title</label>
                            <input type="text" class="form-control" id="job-title" wire:model="jobTitle" required>
                            @error('jobTitle') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        {{-- Job Type --}}
                        <div class="col-md-6 mb-3">
                            <label for="job-type" class="form-label">Job Type</label>
                            <select class="form-select" id="job-type" wire:model="jobType" required>
                                <option value="">-- Select an option --</option>
                                <option value="Full-Time">Full-Time</option>
                                <option value="Part-Time">Part-Time</option>
                            </select>
                            @error('jobType') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        {{-- Job Description --}}
                        <div class="col-md-12 mb-3">
                            <label for="job-description" class="form-label">Job Description</label>
                            <textarea class="form-control" id="job-description" rows="4" wire:model="jobDescription" required></textarea>
                            @error('jobDescription') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        {{-- Job Arrangement --}}
                        <div class="col-md-12 mb-3">
                            <label for="job-arrangement" class="form-label">Job Arrangement</label>
                            <select class="form-select" id="job-arrangement" wire:model="jobArrangement" required>
                                <option value="On-Site">On-Site</option>
                                <option value="Remote">Remote</option>
                            </select>
                            @error('jobArrangement') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
        
                        {{-- Job Responsibilities --}}
                        <div class="col-md-6 mb-3">
                            <label for="job-responsibilities" class="form-label">Job Responsibilities</label>
                            <textarea class="form-control" id="job-responsibilities" rows="4" wire:model="jobResponsibilities" required></textarea>
                            @error('jobResponsibilities') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        {{-- Job Qualifications --}}
                        <div class="col-md-6 mb-3">
                            <label for="job-qualifications" class="form-label">Job Qualifications</label>
                            <textarea class="form-control" id="job-qualifications" rows="4" wire:model="jobQualifications" required></textarea>
                            @error('jobQualifications') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    {{-- Footer --}}
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <button type="button" class="btn btn-secondary" wire:click="closeUpdateModal">Close</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endif
