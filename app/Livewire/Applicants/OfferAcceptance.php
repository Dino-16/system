<?php

namespace App\Livewire\Applicants;

use App\Models\Applicant_Management\Offer;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class OfferAcceptance extends Component
{
    public $search = '';

    public function accept($id)
    {
        $offer = Offer::findOrFail($id);
        $offer->offer_status = 'Accepted';
        $offer->save();

        $candidate = $offer->candidate;
        if (! $candidate) {
            Log::warning('No candidate linked to offer', ['offer_id' => $id]);
            return;
        }

        $payload = [
            'candidate_id' => $candidate->id,
            'offer_date' => $offer->offer_date,
            'offer_status' => $offer->offer_status,
            'candidate_job_title' => $candidate->candidate_job_title,
            'candidate_last_name' => $candidate->candidate_last_name,
            'candidate_first_name' => $candidate->candidate_first_name,
            'candidate_middle_name' => $candidate->candidate_middle_name,
            'candidate_suffix_name' => $candidate->candidate_suffix_name,
            'candidate_address' => $candidate->candidate_address,
            'candidate_email' => $candidate->candidate_email,
            'candidate_phone' => $candidate->candidate_phone,
            'candidate_age' => $candidate->candidate_age,
            'candidate_gender' => $candidate->candidate_gender,
            'candidate_birth_date' => $candidate->candidate_birth_date,
            'candidate_civil_status' => $candidate->candidate_civil_status,
            'skills' => $candidate->skills,
            'experience' => $candidate->experience,
            'education' => $candidate->education,
            'interviewDate' => $candidate->interviewDate,
            'interviewTime' => $candidate->interviewTime,
            'status' => $candidate->status,
        ];

        try {
            $response = Http::asJson()->post('https://hr4.jetlougetravels-ph.com/api/candidates', $payload);

            if ($response->successful()) {
                Log::info('Candidate data sent to Hr 4', ['candidate_id' => $candidate->id]);
            } else {
                Log::error('Failed to send candidate data', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);
            }
        } catch (\Throwable $e) {
            Log::error('Error sending candidate to Hr 4', ['message' => $e->getMessage()]);
        }
    }

    public function reject($id)
    {
        $offer = Offer::findOrFail($id);
        $offer->offer_status = 'Declined';
        $offer->save();
    }

    public function render()
    {

    $offers = Offer::with('candidate')
        ->whereHas('candidate', function ($query) {
            $query->where('candidate_first_name', 'like', '%' . $this->search . '%')
                  ->orWhere('candidate_last_name', 'like', '%' . $this->search . '%');
        })
        ->latest()
        ->paginate(10);

        return view('livewire.applicants.offer-acceptance', [
            'offers' => $offers,
        ]);
    }
}
