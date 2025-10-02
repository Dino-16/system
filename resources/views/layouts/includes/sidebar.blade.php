{{-- Sidebar --}}
<aside id="sidebar" @class('bg-white border-end p-3 shadow-sm')>

    {{-- Profile Section --}}
    <div @class('profile-section text-center')>
    <img src="https://ui-avatars.com/api/?name={{ urlencode(substr(auth()->user()->name, 0, 1)) }}&size=150&background=0d6efd&color=fff"
        alt="Admin Profile" class="profile-img mb-2">
        <h6 @class('fw-semibold mb-1')>{{ auth()->user()->name }}</h6>
        <small @class('text-muted')>Travel Administrator</small>
    </div>

    {{-- Navigation Menu --}}
    <ul @class('nav flex-column')>
        <li @class('nav-item')>
            <a href="{{ route('dashboard') }}"
                @class('nav-link text-dark ' . (request()->is('dashboard') ? 'active' : ''))>
                <i @class('bi bi-grid me-2')></i> Dashboard
            </a>
        </li>

        <li @class('nav-item')>
            <a href="#recruitmentMenu"
            role="button"
            aria-expanded="false"
            aria-controls="recruitmentMenu"
            data-bs-toggle="collapse"
            @class('nav-link text-dark d-flex justify-content-between align-items-center')>
                <span><i @class('bi bi-briefcase-fill me-2')></i> Recruitment</span>
                <i @class('bi bi-chevron-down small')></i>
            </a>

            <div id="recruitmentMenu" @class('collapse ps-4')>
                <ul @class('nav flex-column')>
                    <li @class('nav-item')>
                        <a href="{{ route('requisitions') }}" 
                            @class('nav-link text-dark' . (request()->is('requisitions') ? 'active' : ''))>
                            <i @class('bi bi-file-earmark-plus me-2')></i> Requisition
                        </a>
                    </li>
                    <li @class('nav-item')>
                        <a href="{{ route('job-postings') }}" 
                            @class('nav-link text-dark' . (request()->is('job-postings') ? 'active' : ''))>
                            <i @class('bi bi-megaphone-fill me-2')></i> Job Posting
                        </a>
                    </li>
                    <li @class('nav-item')>
                        <a href="http://website.test" @class('nav-link text-dark')>
                            <i @class('bi bi-globe2 me-2')></i> Website
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <li @class('nav-item')>
            <a href="#applicantsMenu"
            role="button"
            aria-expanded="false"
            aria-controls="applicantsMenu"
            data-bs-toggle="collapse"
            @class('nav-link text-dark d-flex justify-content-between align-items-center')>
                <span><i @class('bi bi-people-fill me-2')></i> Applicants</span>
                <i @class('bi bi-chevron-down small')></i>
            </a>

            <div id="applicantsMenu" @class('collapse ps-4')>
                <ul @class('nav flex-column')>
                    <li @class('nav-item')>
                        <a href="{{ route('applications') }}" 
                            @class('nav-link text-dark' . (request()->is('applications') ? 'active' : ''))>
                            <i @class('bi bi-journal-text me-2')></i> Applications
                        </a>
                    </li>
                    <li @class('nav-item')>
                        <a href="{{ route('filtered-resumes') }}" 
                            @class('nav-link text-dark' . (request()->is('filtered-resumes') ? 'active' : ''))>
                            <i @class('bi bi-funnel-fill me-2')></i> Filtered Applicants
                        </a>
                    </li>
                    <li @class('nav-item')>
                        <a href="{{ route('candidates') }}" 
                            @class('nav-link text-dark' . (request()->is('candidates') ? 'active' : ''))>
                            <i @class('bi bi-person-lines-fill me-2')></i> Candidates
                        </a>
                    </li>
                    <li @class('nav-item')>
                        <a href="" @class('nav-link text-dark')>
                            <i @class('bi bi-calendar-event me-2')></i> Interviews
                        </a>
                    </li>
                    <li @class('nav-item')>
                        <a href="" @class('nav-link text-dark')>
                            <i @class('bi bi-hand-thumbs-up me-2')></i> Offer Acceptance
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <li @class('nav-item')>
            <a href="#onboardingMenu"
            role="button"
            aria-expanded="false"
            aria-controls="onboardingMenu"
            data-bs-toggle="collapse"
            @class('nav-link text-dark d-flex justify-content-between align-items-center')>
                <span><i @class('bi bi-person-badge-fill me-2')></i> Onboarding</span>
                <i @class('bi bi-chevron-down small')></i>
            </a>

            <div id="onboardingMenu" @class('collapse ps-4')>
                <ul @class('nav flex-column')>
                    <li @class('nav-item')>
                        <a href="" @class('nav-link text-dark')>
                            <i @class('bi bi-person-plus-fill me-2')></i> New Hire
                        </a>
                    </li>
                    <li @class('nav-item')>
                        <a href="" @class('nav-link text-dark')>
                            <i @class('bi bi-check2-square me-2')></i> Document Checklist
                        </a>
                    </li>
                    <li @class('nav-item')>
                        <a href="" @class('nav-link text-dark')>
                            <i @class('bi bi-calendar-week me-2')></i> Orientation Plan
                        </a>
                    </li>
                    <li @class('nav-item')>
                        <a href="" @class('nav-link text-dark')>
                            <i @class('bi bi-file-earmark-text me-2')></i> Document Form
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <li @class('nav-item')>
            <a href="#performanceMenu"
            role="button"
            aria-expanded="false"
            aria-controls="performanceMenu"
            data-bs-toggle="collapse"
            @class('nav-link text-dark d-flex justify-content-between align-items-center')>
                <span><i @class('bi bi-bar-chart-fill me-2')></i> Performance</span>
                <i @class('bi bi-chevron-down small')></i>
            </a>

            <div id="performanceMenu" @class('collapse ps-4')>
                <ul @class('nav flex-column')>
                    <li @class('nav-item')>
                        <a href="" @class('nav-link text-dark')>
                            <i @class('bi bi-person-check-fill me-2')></i> New Hire Review
                        </a>
                    </li>
                    <li @class('nav-item')>
                        <a href="" @class('nav-link text-dark')>
                            <i @class('bi bi-clipboard-data-fill me-2')></i> Employee Evaluations
                        </a>
                    </li>
                    <li @class('nav-item')>
                        <a href="" @class('nav-link text-dark')>
                            <i @class('bi bi-file-earmark-bar-graph me-2')></i> Evaluation Forms
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <li @class('nav-item')>
            <a href="#recognitionMenu"
            role="button"
            aria-expanded="false"
            aria-controls="recognitionMenu"
            data-bs-toggle="collapse"
            @class('nav-link text-dark d-flex justify-content-between align-items-center')>
                <span><i @class('bi bi-award-fill me-2')></i> Recognition</span>
                <i @class('bi bi-chevron-down small')></i>
            </a>

            <div id="recognitionMenu" @class('collapse ps-4')>
                <ul @class('nav flex-column')>
                    <li @class('nav-item')>
                        <a href="{{ route('shout-outs') }}" 
                        @class('nav-link text-dark'. (request()->is('shout-outs') ? 'active' : ''))>
                            <i @class('bi bi-megaphone me-2')></i> Give a Shoutout
                        </a>
                    </li>
                    <li @class('nav-item')>
                        <a href="{{ route('shoutout-records') }}" @class('nav-link text-dark'. (request()->is('shoutout-records') ? 'active' : ''))>
                            <i @class('bi bi-journal-richtext me-2')></i> Shoutout Records
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <hr>

        <livewire:auth.logout />

    </ul>

</aside>