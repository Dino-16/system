<?php

namespace App\Livewire\Applicants;

use Livewire\Component;
use App\Models\Applicant_Management\ResumeData;
use App\Models\Applicant_Management\Candidate;

class FilteredResumes extends Component
{
    public $activeRating = 'Excellent';

    public $showCandidateSelection = false;

    public $selectedCandidateId;

    public $selectedCandidate;

    public $scheduleDate = '';
    public $scheduleTime = '';

    public function setCandidate($id)
    {
        $this->selectedCandidateId = $id;
        $this->showCandidateSelection = true;
    }

    public function postCandidate()
    {
        $this->selectedCandidate = ResumeData::findOrFail($this->selectedCandidateId);

        // Determine status based on interview date
        $today = \Carbon\Carbon::now('Asia/Manila')->toDateString();
        $status = ($this->scheduleDate <= $today) ? 'Initial' : 'Scheduled';

        Candidate::create([
            'applicant_job_id'       => $this->selectedCandidate->applicant_job_id, 
            'candidate_job_title'    => $this->selectedCandidate->applicant_job_title, 
            'candidate_last_name'    => $this->selectedCandidate->applicant_last_name,
            'candidate_first_name'   => $this->selectedCandidate->applicant_first_name,
            'candidate_middle_name'  => $this->selectedCandidate->applicant_middle_name,
            'candidate_suffix_name'  => $this->selectedCandidate->applicant_suffix_name,
            'candidate_address'      => $this->selectedCandidate->applicant_address,
            'candidate_email'        => $this->selectedCandidate->applicant_email,
            'candidate_phone'        => $this->selectedCandidate->applicant_phone,
            'candidate_age'          => $this->selectedCandidate->applicant_age,
            'candidate_gender'       => $this->selectedCandidate->applicant_gender,
            'candidate_birth_date'   => $this->selectedCandidate->applicant_birth_date,
            'candidate_civil_status' => $this->selectedCandidate->applicant_civil_status,
            'skills'                 => $this->selectedCandidate->applicant_skills,
            'experience'             => $this->selectedCandidate->applicant_experience,
            'education'              => $this->selectedCandidate->applicant_education,
            'interviewDate'          => $this->scheduleDate,
            'interviewTime'          => $this->scheduleTime,
            'status'                 => $status,
        ]);

        $this->selectedCandidate->delete();


        session()->flash('success', 'Interview schedule posted successfully.');

        $this->closeSetCandidate();
    }

    public function closeSetCandidate()
    {
        $this->showCandidateSelection = false;
    }

    public function setRating($rating)
    {
        $this->activeRating = $rating;
    }

    public function render()
    {
        $groupedApplicants = ResumeData::all()->groupBy('ratings');
        $filteredApplicants = $groupedApplicants[$this->activeRating] ?? collect();

        return view('livewire.applicants.filtered-resumes', [
            'filteredApplicants' => $filteredApplicants,
            'activeRating' => $this->activeRating,
        ]);
    }

}
