<div @class(['card', 'p-5'])>
    <x-alert-success />

    <!-- Header -->
    <div class="mb-4 text-center">
        <h2 class="fw-bold text-primary">Employee Performance Review</h2>
        <p class="text-muted fs-5">Quarterly Evaluation Form</p>
        <p class="text-muted">Please complete the form below to assess and support employee growth.</p>
    </div>

    <form wire:submit.prevent="submitEvaluation">
        <!-- Employee Details -->
        <div class="mb-5">
            <h5 class="fw-semibold mb-3 text-dark">Employee Information</h5>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Full Name</label>
                    <input type="text" wire:model="full_name" placeholder="e.g., Jane Doe" class="form-control">
                    @error('full_name') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Review Period</label>
                    <select wire:model="review_period" class="form-select">
                        <option value="">Select quarter</option>
                        <option value="Q1">Q1</option>
                        <option value="Q2">Q2</option>
                        <option value="Q3">Q3</option>
                        <option value="Q4">Q4</option>
                    </select>
                    @error('review_period') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Job Title</label>
                    <input type="text" wire:model="job_title" placeholder="e.g., Software Engineer" class="form-control">
                    @error('job_title') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Department</label>
                    <input type="text" wire:model="department" placeholder="e.g., Engineering" class="form-control">
                    @error('department') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Reviewer Name</label>
                    <input type="text" wire:model="reviewer_name" placeholder="e.g., John Smith" class="form-control">
                    @error('reviewer_name') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>
        </div>

        <!-- Core Competencies -->
        <div class="mb-5">
            <h5 class="fw-semibold mb-3 text-dark">Core Competency Ratings</h5>
            @foreach (['Communication', 'Teamwork', 'Problem Solving', 'Adaptability', 'Leadership', 'Initiative'] as $competency)
                <div class="mb-3">
                    <label class="form-label">{{ $competency }}</label>
                    <select wire:model="competencies.{{ $competency }}" class="form-select">
                        <option value="">Rate from 1 (Low) to 5 (High)</option>
                        @for ($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                    @error("competencies.$competency") <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            @endforeach
        </div>

        <!-- Feedback -->
        <div class="mb-5">
            <h5 class="fw-semibold mb-3 text-dark">Feedback & Observations</h5>
            <div class="mb-3">
                <label class="form-label">Strengths</label>
                <textarea wire:model="strengths" rows="3" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Areas for Improvement</label>
                <textarea wire:model="improvements" rows="3" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Development Plan & Goals</label>
                <textarea wire:model="development_plan" rows="3" class="form-control"></textarea>
            </div>
        </div>

        <!-- Overall Assessment -->
        <div class="mb-5">
            <h5 class="fw-semibold mb-3 text-dark">Overall Assessment</h5>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Employee Rating</label>
                    <select wire:model="employee_rating" class="form-select">
                        <option value="">Select overall rating</option>
                        @for ($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                    @error('employee_rating') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Reviewer Confidence Level</label>
                    <select wire:model="confidence_level" class="form-select">
                        <option value="">Select confidence level</option>
                        @for ($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                    @error('confidence_level') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>
        </div>

        <!-- Buttons -->
        <div class="text-center d-flex justify-content-center gap-3">
            <button type="button" class="btn btn-outline-secondary px-4">Save as Draft</button>
            <button type="submit" class="btn btn-success px-4">Submit Evaluation</button>
        </div>
    </form>
</div>
