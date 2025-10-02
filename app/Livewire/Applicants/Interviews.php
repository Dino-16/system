<?php

namespace App\Livewire\Applicants;

use Livewire\Component;
use App\Models\Applicant_Management\Candidate;
use Carbon\Carbon;

class Interviews extends Component
{
    public $selectedCandidate;

    public $showModal = false;

    public $interviewStage = null;

    public function viewCandidate($id)
    {
        $this->selectedCandidate = Candidate::findOrFail($id);
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function final($id)
    {
        $status = Candidate::findOrFail($id);
        $status->status = 'Final';
        $status->save();
    }
    
    public function reject($id)
    {
        $status = Candidate::findOrFail($id);
        $status->status = 'Rejected';
        $status->save();
    }

    public function approve($id)
    {
        $status = Candidate::findOrFail($id);
        $status->status = 'Passed';
        $status->save();
    }

    public function render()
    {
        $today = Carbon::now('Asia/Manila')->toDateString();

        $query = Candidate::query();

        if ($this->interviewStage === 'Scheduled') {
            // "Initial" means status is 'Scheduled' and interview is today
            $query->where('status', 'Scheduled')
                ->orWhere('status', 'Initial')
                ->whereDate('interviewDate', $today);
        } elseif ($this->interviewStage === 'Final') {
            $query->where('status', 'Final');
        } elseif ($this->interviewStage === 'All') {
            // Show all candidates with valid interview statuses
            $query->whereIn('status', ['Scheduled', 'Final', 'Rejected', 'Passed']);
        }

        $candidates = $query->orderBy('created_at', 'desc')->get();


        return view('livewire.applicants.interviews', [
            'candidates' => $candidates,
        ]);
    }
}
