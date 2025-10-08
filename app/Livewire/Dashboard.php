<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Recruitment_Management\Requisition;
use App\Models\Recruitment_Management\JobPosting;

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
        $totalRequisitions = Requisition::where('status', 'Open')->count();
        $totalPostedJobs = JobPosting::where('status', 'Posted')->count();

        return view('livewire.dashboard', [
            'totalRequisitions' => $totalRequisitions,
            'totalPostedJobs' => $totalPostedJobs,
        ]);
    }
}