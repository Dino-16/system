@if($showFilteringModal && $filterApplicant)
<div 
    @class('modal fade show d-block') 
    tabindex="-1" 
    role="dialog" 
    aria-modal="true" 
    aria-labelledby="applicantReviewLabel" 
    style="background: rgba(0,0,0,0.5);"
>
    <div @class('modal-dialog modal-xl modal-dialog-centered')>
        <div @class('modal-content')>
            <div @class('modal-header bg-primary text-white')>
                <h5 @class('modal-title') id="applicantReviewLabel">Applicant Review</h5>
                <button type="button" @class('btn-close btn-close-white') wire:click="closeModal" aria-label="Close"></button>
            </div>

            <div @class('modal-body')>
                <div @class('row')>

                    {{-- Resume Preview --}}
                    <div @class('col-md-6 position-relative')>
                        @if($filterApplicant->applicant_resume_file)
                            <iframe 
                                src="{{ route('resume.view', ['id' => $filterApplicant->id]) }}" 
                                style="width:100%;height:80vh;" 
                                frameborder="0" 
                                loading="lazy"
                                onerror="this.outerHTML='<div class=\'text-muted text-center mt-5\'><i class=\'bi bi-file-earmark-x\' style=\'font-size: 2rem;\'></i><p>Resume not available.</p></div>';"
                            ></iframe>
                        @else
                            <div class="text-center text-muted mt-5">
                                <i class="bi bi-file-earmark-x" style="font-size: 2rem;"></i>
                                <p>No resume uploaded.</p>
                            </div>
                        @endif
                    </div>

                    {{-- Applicant Form --}}
                    <div @class('col-md-6')>
                        <form wire:submit.prevent="saveReview">
                            <hr class="my-3">
                            <h6 class="text-muted">Fill up applicant information</h6>

                            <x-alert-success />

                            <div @class('row')>

                                {{-- Age --}}
                                <div @class('col-md-4 mb-3')>
                                    <x-input-label for="age" :value="__('Age')" />
                                    <x-text-input wire:model="age" id="age" type="number" min="0" placeholder="Enter age..." required @class('form-control') />
                                    <x-input-error field="age" />
                                </div>

                                {{-- Gender --}}
                                <div @class('col-md-4 mb-3')>
                                    <x-input-label for="gender" :value="__('Gender')" />
                                    <x-select-input
                                        wire:model="gender"
                                        id="gender"
                                        :options="[
                                            'Male' => 'Male',
                                            'Female' => 'Female',
                                            'Other' => 'Other'
                                        ]"
                                        required
                                        class="form-select"
                                    />
                                    <x-input-error field="gender" />
                                </div>

                                {{-- Birth Date --}}
                                <div @class('col-md-4 mb-3')>
                                    <x-input-label for="birth_date" :value="__('Birth Date')" />
                                    <x-text-input wire:model="birth_date" id="birth_date" type="date" required @class('form-control') />
                                    <x-input-error field="birth_date" />
                                </div>

                                {{-- Civil Status --}}
                                <div @class('col-md-6 mb-3')>
                                    <x-input-label for="civil_status" :value="__('Civil Status')" />
                                    <select wire:model="civil_status" id="civil_status" required @class('form-select')>
                                        <option value="">Select status</option>
                                        <option value="Single">Single</option>
                                        <option value="Married">Married</option>
                                        <option value="Widowed">Widowed</option>
                                        <option value="Separated">Separated</option>
                                    </select>
                                    <x-input-error field="civil_status" />
                                </div>

                                {{-- Height --}}
                                <div @class('col-md-3 mb-3')>
                                    <x-input-label for="height" :value="__('Height (cm)')" />
                                    <x-text-input wire:model="height" id="height" type="number" min="0" placeholder="e.g. 170" required @class('form-control') />
                                    <x-input-error field="height" />
                                </div>

                                {{-- Weight --}}
                                <div @class('col-md-3 mb-3')>
                                    <x-input-label for="weight" :value="__('Weight (kg)')" />
                                    <x-text-input wire:model="weight" id="weight" type="number" min="0" placeholder="e.g. 65" required @class('form-control') />
                                    <x-input-error field="weight" />
                                </div>

                                {{-- Skills --}}
                                <div @class('col-md-6 mb-3')>
                                    <x-input-label for="skills" :value="__('Skills')" />
                                    <x-text-area wire:model="skills" id="skills" placeholder="List applicant skills..." required />
                                    <x-input-error field="skills" />
                                </div>

                                {{-- Education --}}
                                <div @class('col-md-6 mb-3')>
                                    <x-input-label for="education" :value="__('Education')" />
                                    <x-text-area wire:model="education" id="education" placeholder="Educational background..." required />
                                    <x-input-error field="education" />
                                </div>

                                {{-- Experience --}}
                                <div @class('col-md-12 mb-3')>
                                    <x-input-label for="experience" :value="__('Experience')" />
                                    <x-text-area wire:model="experience" id="experience" placeholder="Work experience..." required />
                                    <x-input-error field="experience" />
                                </div>

                                {{-- Status --}}
                                <div @class('col-md-12 mb-3')>
                                    <x-input-label for="status" :value="__('Ratings')" />
                                    <x-select-input
                                        wire:model="status"
                                        id="status"
                                        :options="[
                                            'Good' => 'Good',
                                            'Excellent' => 'Excellent',
                                            'Bad' => 'Bad'
                                        ]"
                                        required
                                        class="form-select"
                                    />
                                    <x-input-error field="status" />
                                </div>
                            </div>

                            <div @class('modal-footer')>
                                <button type="button" @class('btn btn-secondary') wire:click="closeModal">Close</button>
                                <x-button-primary>Save</x-button-primary>    
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endif