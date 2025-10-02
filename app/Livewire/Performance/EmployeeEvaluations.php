<?php

namespace App\Livewire\Performance;

use Livewire\Component;
use App\Models\Performance_Management\Evaluation;
use Livewire\WithPagination;

class EmployeeEvaluations extends Component
{   
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage(); 
    }

    public function render()
    {
        $evaluations = Evaluation::where('full_name', 'like', "%{$this->search}%")
            ->orWhere('department', 'like', "%{$this->search}%")
            ->orWhere('review_period', 'like', "%{$this->search}%")
            ->latest()
            ->paginate(10);

        return view('livewire.performance.employee-evaluations', [
            'evaluations' => $evaluations,
        ]);
    }
}
