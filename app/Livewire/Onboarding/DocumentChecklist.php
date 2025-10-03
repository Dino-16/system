<?php

namespace App\Livewire\Onboarding;

use Livewire\Component;
use App\Models\Onboarding\Document;

class DocumentChecklist extends Component
{
    public $newHireName = '';

    public $resume = false;
    public $signed_application_form = false;
    public $valid_government_id = false;
    public $transcript_of_records = false;
    public $medical_certificate = false;
    public $nbi_clearance = false;
    public $barangay_clearance = false;
    public $signed_job_offer_contract = false;

    public function saveChecklist()
    {
        $this->validate([
            'newHireName' => 'required|string|max:255',
        ]);

        Document::create([
            'new_hire_name' => $this->newHireName,
            'resume' => $this->resume,
            'signed_application_form' => $this->signed_application_form,
            'valid_government_id' => $this->valid_government_id,
            'transcript_of_records' => $this->transcript_of_records,
            'medical_certificate' => $this->medical_certificate,
            'nbi_clearance' => $this->nbi_clearance,
            'barangay_clearance' => $this->barangay_clearance,
            'signed_job_offer_contract' => $this->signed_job_offer_contract,
        ]);

        $this->reset([
            'newHireName',
            'resume',
            'signed_application_form',
            'valid_government_id',
            'transcript_of_records',
            'medical_certificate',
            'nbi_clearance',
            'barangay_clearance',
            'signed_job_offer_contract',
        ]);

        session()->flash('success', 'Checklist saved successfully!');
    }

    public function render()
    {   
         $checklists = Document::latest()->get();

        return view('livewire.onboarding.document-checklist', [
            'checklists' => $checklists,
        ]);
    }
}