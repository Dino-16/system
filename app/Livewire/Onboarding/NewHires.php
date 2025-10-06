<?php

namespace App\Livewire\Onboarding;

use Livewire\Component;

class NewHires extends Component
{
    public $employees = [];

    public function mount()
    {
        $response = Http::get('http://hr4.jetlougetravels-ph.com/api/employees'); // Project A URL

        if ($response->successful()) {
            $this->employees = $response->json();
        }
    }

    public function render()
    {
        return view('livewire.onboarding.new-hires');
    }
}
