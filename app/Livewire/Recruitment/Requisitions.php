<?php

namespace App\Livewire\Recruitment;

use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use App\Models\Recruitment_Management\Requisition;

class Requisitions extends Component
{
    use WithPagination, WithoutUrlPagination; 

    public $search = '';

    public $statusFilter = 'All';

    public $selectedRequisition;
    
    public $showModal = false;

    public $showDraftConfirmModal = false;

    public $confirmDraftId;

    public $showCloseConfirmModal = false;

    public $confirmCloseId;

    public function viewRequisition($id)
    {
        $this->selectedRequisition = Requisition::findOrFail($id);
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function draft($id)
    {
        $this->confirmDraftId = $id;
        $this->showDraftConfirmModal = true;
    }

    public function draftConfirmed()
    {
        $jobRequisition = Requisition::findOrFail($this->confirmDraftId);
        $jobRequisition->status = 'Draft';
        $jobRequisition->save();
        $this->closeDraftModal();
    }

    public function closeDraftModal()
    {
        $this->showDraftConfirmModal = false;
    }

    public function close($id)
    {
        $this->confirmCloseId = $id;
        $this->showCloseConfirmModal = true;
    }

    public function closeConfirmed()
    {
        $jobRequisition = Requisition::findOrFail($this->confirmCloseId);
        $jobRequisition->status = 'Closed';
        $jobRequisition->save();
        $this->closeConfirmModal();
    }

    public function closeConfirmModal()
    {
        $this->showCloseConfirmModal = false;
    }
    
    public function render()
    {   
        $statusCounts = [
            'Open' => Requisition::where('status', 'Open')->count(),
            'In-Progress' => Requisition::where('status', 'In-Progress')->count(),
            'Closed' => Requisition::where('status', 'Closed')->count(),
            'Draft' => Requisition::where('status', 'Draft')->count(),
            'All' => Requisition::count(),
        ];
        
        $query = Requisition::query()->latest();

        if ($this->statusFilter !== 'All') {
            $query->where('status', $this->statusFilter);
        }

        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('department', 'like', '%' . $this->search . '%')
                ->orWhere('requested_by', 'like', '%' . $this->search . '%')
                ->orWhere('requisition_title', 'like', '%' . $this->search . '%');
            });
        }

        $requisitions = $query->paginate(5);

        return view('livewire.recruitment.requisitions', [
            'statusCounts' => $statusCounts,
            'requisitions' => $requisitions,
        ]);
    }
}
