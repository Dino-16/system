<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use App\Models\Recruitment_Management\JobPosting;
use App\Models\Applicant_Management\Application;
use App\Models\Applicant_Management\Candidate;
use App\Models\Social_Recognition\Recognition;

class Dashboard extends Component
{
    public $currentDateTime;

    public function mount()
    {
        $this->currentDateTime = now()->format('l, F j, Y h:i:s A');
    }

    public function updateDateTime()
    {
        $this->currentDateTime = now()->format('l, F j, Y h:i:s A');
    }

    public function render()
    {   
        $totalPostedJobs = JobPosting::where('status', 'Posted')->count();
        $totalApplicants = Application::count();
        $totalCandidates = Candidate::count();


        $employeeResponse = Http::get('http://hr4.jetlougetravels-ph.com/api/employees');
        $employeeData = $employeeResponse->json();
        $totalEmployee = is_array($employeeData) ? count($employeeData) : 0;

        $statusCountCandidates = [
            'Failed' => Candidate::where('status', 'Failed')->count(),
            'Rejected' => Candidate::where('status', 'Rejected')->count(),
            'Scheduled' => Candidate::where('status', 'Scheduled')->count(),
            'Passed' => Candidate::where('status', 'Passed')->count(),
            'Interviewing' => Candidate::whereIn('status', ['Initial', 'Final'])->count(),
        ];

        $recognitions = Recognition::latest()->take(1)->get();

        return view('livewire.dashboard', [
            'totalPostedJobs' => $totalPostedJobs,
            'totalApplicants' => $totalApplicants,
            'totalCandidates' => $totalCandidates,
            'totalEmployee' => $totalEmployee,
            'statusCountCandidates' => $statusCountCandidates,
            'recognitions' => $recognitions 
        ]);
    }
}