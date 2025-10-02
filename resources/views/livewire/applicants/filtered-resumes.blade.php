<div>
    <x-alert-success />

    {{-- Rating Filter Buttons --}}
    <div @class('card shadow-sm mb-5 p-3')>
        <div class="d-flex justify-content-between align-items-center">
            <div>
            @foreach (['Very Good', 'Good', 'Bad'] as $rating)
                <button type="button"
                    class="btn me-2 border
                        @if($activeRating === $rating) btn-default
                        @else btn-default @endif"
                    wire:click="setRating('{{ $rating }}')">
                    
                    @if($rating === 'Very Good')
                        <i class="bi bi-star me-1"></i>
                    @elseif($rating === 'Good')
                        <i class="bi bi-hand-thumbs-up me-1"></i>
                    @elseif($rating === 'Bad')
                        <i class="bi bi-hand-thumbs-down me-1"></i>
                    @endif

                    {{ $rating }}
                </button>
            @endforeach
            </div>
        </div>
    </div>

    {{-- Filtered Applicants --}}
    <div class="row gy-4">
        @forelse ($filteredApplicants as $applicant)
            <div class="col-md-4">
                <div class="card shadow-sm border">
                    <div class="card-header bg-white border-secondary">
                        <strong>{{ ucwords($applicant->applicant_first_name . ' ' . $applicant->applicant_middle_name . ' ' . $applicant->applicant_last_name) }}</strong>
                        <span class="float-end fs-5">
                            @if($applicant->ratings === 'Very Good')
                                <i class="bi bi-star text-warning" title="Very Good"></i>
                            @elseif($applicant->ratings === 'Good')
                                <i class="bi bi-hand-thumbs-up text-primary" title="Good"></i>
                            @elseif($applicant->ratings === 'Bad')
                                <i class="bi bi-hand-thumbs-down text-danger" title="Bad"></i>
                            @else
                                <i class="bi bi-question-circle text-secondary" title="Unrated"></i>
                            @endif
                        </span>
                    </div>

                    <div class="card-body p-0">
                        <div class="accordion" id="accordion-{{ $applicant->id }}">
                            {{-- Personal Information --}}
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="personal-heading-{{ $applicant->id }}">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#personal-collapse-{{ $applicant->id }}"
                                        aria-expanded="false"
                                        aria-controls="personal-collapse-{{ $applicant->id }}">
                                        Personal Information
                                    </button>
                                </h2>
                                <div id="personal-collapse-{{ $applicant->id }}"
                                    class="accordion-collapse collapse"
                                    aria-labelledby="personal-heading-{{ $applicant->id }}">
                                    <div class="accordion-body">
                                        <p><i class="bi bi-envelope"></i> {{ $applicant->applicant_email }}</p>
                                        <p><i class="bi bi-geo-alt"></i> {{ $applicant->applicant_address }}</p>
                                    </div>
                                </div>
                            </div>

                            {{-- Application Details --}}
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="details-heading-{{ $applicant->id }}">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#details-collapse-{{ $applicant->id }}"
                                        aria-expanded="false"
                                        aria-controls="details-collapse-{{ $applicant->id }}">
                                        Application Details
                                    </button>
                                </h2>
                                <div id="details-collapse-{{ $applicant->id }}"
                                    class="accordion-collapse collapse"
                                    aria-labelledby="details-heading-{{ $applicant->id }}">
                                    <div class="accordion-body">
                                        <p><strong>Skills:</strong>
                                            @foreach (explode(',', $applicant->applicant_skills) as $skill)
                                                <span class="badge bg-light text-dark border me-1">{{ trim($skill) }}</span>
                                            @endforeach
                                        </p>
                                        <p><strong>Experience:</strong> {{ $applicant->applicant_experience }}</p>
                                        <p><strong>Education:</strong> {{ $applicant->applicant_education }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer text-end">
                        <button type="button" class="btn btn-primary btn-sm"
                            wire:click="setCandidate({{ $applicant->id }})">
                            Set as candidate
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-muted text-center">No applicants in this category.</div>
        @endforelse
    </div>

    {{-- Modal --}}
    @include('livewire.applicants.includes.candidate-review-modal') 
</div>