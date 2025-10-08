<?php

namespace App\Livewire\Applicants;

use Livewire\Component;
use App\Models\FacilitiesRequest;
use Illuminate\Support\Facades\Auth;

class RequestRooms extends Component
{
    public function render()
    {
        $requests = FacilitiesRequest::where('requested_by', Auth::id())
            ->orderByDesc('created_at')
            ->get();

        return view('livewire.applicants.request-rooms', [
            'requests' => $requests,
        ]);
    }
}
