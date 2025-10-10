<?php

namespace App\Livewire\Onboarding;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use App\Models\Onboarding\Document;

class DocumentChecklist extends Component
{
    public $newHireName = '';
    public $newHireList = [];
    public $existingChecklist;

    public $resume = false;
    public $signed_application_form = false;
    public $valid_government_id = false;
    public $transcript_of_records = false;
    public $medical_certificate = false;
    public $nbi_clearance = false;
    public $barangay_clearance = false;
    public $signed_job_offer_contract = false;

    public function mount()
    {
        $response = Http::get('http://hr4.jetlougetravels-ph.com/api/employees');
        $this->newHireList = $response->json(); // assumes array of names
    }

    public function updatedNewHireName($value)
    {
        $this->existingChecklist = Document::where('new_hire_name', $value)->first();

        if ($this->existingChecklist) {
            $this->resume = $this->existingChecklist->resume;
            $this->signed_application_form = $this->existingChecklist->signed_application_form;
            $this->valid_government_id = $this->existingChecklist->valid_government_id;
            $this->transcript_of_records = $this->existingChecklist->transcript_of_records;
            $this->medical_certificate = $this->existingChecklist->medical_certificate;
            $this->nbi_clearance = $this->existingChecklist->nbi_clearance;
            $this->barangay_clearance = $this->existingChecklist->barangay_clearance;
            $this->signed_job_offer_contract = $this->existingChecklist->signed_job_offer_contract;
        } else {
            $this->reset([
                'resume',
                'signed_application_form',
                'valid_government_id',
                'transcript_of_records',
                'medical_certificate',
                'nbi_clearance',
                'barangay_clearance',
                'signed_job_offer_contract',
            ]);
        }
    }

    public function saveChecklist()
    {
        $this->validate([
            'newHireName' => 'required|string|max:255',
        ]);

        Document::updateOrCreate(
            ['new_hire_name' => $this->newHireName],
            [
                'resume' => $this->resume,
                'signed_application_form' => $this->signed_application_form,
                'valid_government_id' => $this->valid_government_id,
                'transcript_of_records' => $this->transcript_of_records,
                'medical_certificate' => $this->medical_certificate,
                'nbi_clearance' => $this->nbi_clearance,
                'barangay_clearance' => $this->barangay_clearance,
                'signed_job_offer_contract' => $this->signed_job_offer_contract,
            ]
        );

        session()->flash('success', 'Checklist saved successfully!');
    }

    public function editChecklist($id)
    {
        $doc = Document::findOrFail($id);

        $this->newHireName = $doc->new_hire_name;
        $this->existingChecklist = $doc;

        $this->resume = (bool) $doc->resume;
        $this->signed_application_form = (bool) $doc->signed_application_form;
        $this->valid_government_id = (bool) $doc->valid_government_id;
        $this->transcript_of_records = (bool) $doc->transcript_of_records;
        $this->medical_certificate = (bool) $doc->medical_certificate;
        $this->nbi_clearance = (bool) $doc->nbi_clearance;
        $this->barangay_clearance = (bool) $doc->barangay_clearance;
        $this->signed_job_offer_contract = (bool) $doc->signed_job_offer_contract;

        session()->flash('success', 'Loaded checklist for update.');
    }

    public function render()
    {
        $checklists = Document::latest()->get();

        return view('livewire.onboarding.document-checklist', [
            'checklists' => $checklists,
        ]);
    }
}