<?php

namespace App\Livewire\Recognition;

use Livewire\Component;
use App\Models\Social_Recognition\Recognition;
use Livewire\WithPagination;

class ShoutoutRecords extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Recognition::query();

        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('type', 'like', '%' . $this->search . '%')
                  ->orWhere('message', 'like', '%' . $this->search . '%');
            });
        }

        $recognitions = $query->latest()->paginate(10); // Show 10 per page

        return view('livewire.recognition.shoutout-records', [
            'recognitions' => $recognitions,
        ]);
    }
}