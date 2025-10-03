<?php

namespace App\Livewire\Applicants;

use Livewire\Component;
use App\Models\Applicant_Management\Offer;

class OfferAcceptance extends Component
{
    public $search = '';

    public function accept($id)
    {
        $offer = Offer::findOrFail($id);
        $offer->offer_status = 'Accepted';
        $offer->save();
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
