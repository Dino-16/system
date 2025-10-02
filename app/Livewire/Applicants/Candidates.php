<?php

namespace App\Livewire\Applicants;

use Livewire\Component;
use App\Models\Applicant_Management\Candidate;

class Candidates extends Component
{
    public function render()
    {   
        $candidates = Candidate::latest()->get();
        return view('livewire.applicants.candidates', [
            'candidates' => $candidates,
        ]);
    }
}
