<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Recruitment_Management\Requisition;
use App\Models\Recruitment_Management\JobPosting;

class Dashboard extends Component
{
    public function render()
    {   
        $totalRequisitions = ['Requisitions' => Requisition::where('status', 'Open')->count()];
        $totalPostedJobs = ['Jobs' => JobPosting::where('status', 'Posted')->count()];

        return view('livewire.dashboard', [
            'totalRequisitions' => $totalRequisitions,
            'totalPostedJobs' => $totalPostedJobs,
        ]);
    }
}
