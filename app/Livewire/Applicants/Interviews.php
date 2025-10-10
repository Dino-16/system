<?php

namespace App\Livewire\Applicants;

use Livewire\Component;
use App\Models\Applicant_Management\Candidate;
use App\Models\Applicant_Management\Offer;
use Carbon\Carbon;

class Interviews extends Component
{
    public $selectedCandidate;

    public $showModal = false;

    public $interviewStage = 'All';

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
        $candidate = Candidate::findOrFail($id); 
        $candidate->status = 'Passed';
        $candidate->save();

        if (!$candidate->offerAcceptance) {
            Offer::create([
                'candidate_id' => $candidate->id,
                'offer_date' => now(),
                'offer_status' => 'Pending',
            ]);
        }
    }

    public function render()
    {
        $today = Carbon::now('Asia/Manila')->toDateString();

        $query = Candidate::query();

        if ($this->interviewStage === 'Scheduled') {
            $query->where('status', 'Scheduled')
                ->orWhere('status', 'Initial')
                ->whereDate('interviewDate', $today);
        } elseif ($this->interviewStage === 'Final') {
            $query->where('status', 'Final');
        } elseif ($this->interviewStage === 'All') {
            $query->whereIn('status', ['Scheduled', 'Final', 'Rejected', 'Passed']);
        }

        $candidates = $query->orderBy('created_at', 'desc')->get();


        return view('livewire.applicants.interviews', [
            'candidates' => $candidates,
        ]);
    }
}
