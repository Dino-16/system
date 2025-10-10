<div>
    {{-- Success Alert --}}
    <x-alert-success />

    {{-- Rating Filter Row --}}
    <div class="row mb-3">
        <div class="col-md-4">
            <button type="button"
                wire:click="setRating('Excellent')"
                class="btn w-100 d-flex align-items-center justify-content-center
                    @if($activeRating === 'Excellent') btn-primary
                    @else btn-outline-secondary @endif">
                <i class="bi bi-star-fill me-2"></i> Excellent
            </button>
        </div>
        <div class="col-md-4">
            <button type="button"
                wire:click="setRating('Good')"
                class="btn w-100 d-flex align-items-center justify-content-center
                    @if($activeRating === 'Good') btn-primary
                    @else btn-outline-secondary @endif">
                <i class="bi bi-hand-thumbs-up-fill me-2"></i> Good
            </button>
        </div>
        <div class="col-md-4">
            <button type="button"
                wire:click="setRating('Bad')"
                class="btn w-100 d-flex align-items-center justify-content-center
                    @if($activeRating === 'Bad') btn-primary
                    @else btn-outline-secondary @endif">
                <i class="bi bi-hand-thumbs-down-fill me-2"></i> Bad
            </button>
        </div>
    </div>

    {{-- Filtered Applicants --}}
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @forelse ($filteredApplicants as $applicant)
            <div class="col">
                <div class="card shadow-sm h-100 border-0">
                    {{-- Header --}}
                    <div class="card-header bg-white border-bottom">
                        <div class="d-flex justify-content-between align-items-center">
                            <strong class="text-dark">
                                {{ ucwords($applicant->applicant_first_name . ' ' . $applicant->applicant_middle_name . ' ' . $applicant->applicant_last_name) }}
                            </strong>
                            <span class="fs-5">
                                @if($applicant->ratings === 'Excellent')
                                    <i class="bi bi-star text-warning" title="Excellent"></i>
                                @elseif($applicant->ratings === 'Good')
                                    <i class="bi bi-hand-thumbs-up text-primary" title="Good"></i>
                                @elseif($applicant->ratings === 'Bad')
                                    <i class="bi bi-hand-thumbs-down text-danger" title="Bad"></i>
                                @else
                                    <i class="bi bi-question-circle text-secondary" title="Unrated"></i>
                                @endif
                            </span>
                        </div>
                    </div>

                    {{-- Body --}}
                    <div class="card-body px-3 py-2">
                        <div class="accordion accordion-flush" id="accordion-{{ $applicant->id }}">
                            {{-- Personal Info --}}
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
                                        <p><i class="bi bi-envelope me-2"></i>{{ $applicant->applicant_email }}</p>
                                        <p><i class="bi bi-telephone me-2"></i>{{ $applicant->applicant_phone }}</p>
                                        <p><i class="bi bi-calendar me-2"></i>Birth Date: {{ $applicant->applicant_birth_date }}</p>
                                        <p><i class="bi bi-person-badge me-2"></i>Civil Status: {{ $applicant->applicant_civil_status }}</p>
                                        <p><i class="bi bi-hourglass-split me-2"></i>Age: {{ $applicant->applicant_age }}</p>
                                        <p><i class="bi bi-gender-ambiguous me-2"></i>Gender: {{ $applicant->applicant_gender }}</p>
                                        <p><i class="bi bi-arrows-vertical me-2"></i>Height: {{ $applicant->applicant_height }}</p>
                                        <p><i class="bi bi-bar-chart me-2"></i>Weight: {{ $applicant->applicant_weight }}</p>
                                        <p><i class="bi bi-geo-alt me-2"></i>{{ $applicant->applicant_address }}</p>
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
                                        <p><i class="bi bi-tools me-2"></i>Skills:</p>
                                        <div class="mb-2">
                                            @foreach (explode(',', $applicant->applicant_skills) as $skill)
                                                <span class="badge bg-light text-dark border me-1">{{ trim($skill) }}</span>
                                            @endforeach
                                        </div>
                                        <p><i class="bi bi-briefcase me-2"></i>Experience: {{ $applicant->applicant_experience }}</p>
                                        <p><i class="bi bi-mortarboard me-2"></i>Education: {{ $applicant->applicant_education }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Footer --}}
                    <div class="card-footer bg-white border-top text-end">
                        <button type="button" class="btn btn-sm btn-primary"
                            wire:click="setCandidate({{ $applicant->id }})">
                            Set as candidate
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="d-flex justify-content-center align-items-center w-100 py-5" style="min-height: 200px;">
                <span class="text-muted fs-5">No applicants in this category.</span>
            </div>
        @endforelse
    </div>

    {{-- Modal --}}
    @include('livewire.applicants.includes.candidate-review-modal')
</div>