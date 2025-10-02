<?php

namespace App\Livewire\Recruitment;

use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use App\Models\Recruitment_Management\Requisition;
use App\Models\Recruitment_Management\JobPosting;
use Illuminate\Pagination\LengthAwarePaginator;

class JobPostings extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $selectedJob = '';

    public $search = '';

    public $statusFilter = 'All';


    public $perPage = 3;

    public $page = 1;

    protected $queryString = ['page'];

    public $showUpdateModal = false;

    public $jobTitle;
    public $jobType;
    public $jobDescription;
    public $jobArrangement;
    public $jobResponsibilities;
    public $jobQualifications;

    public $showRemoveConfirmModal = false;

    public $confirmRemoveId;

    public function postJob($id)
    {
        $this->selectedJob = Requisition::findOrFail($id);

        JobPosting::create([
            'requisition_id' => $this->selectedJob->id,
            'job_title' => $this->selectedJob->requisition_title,
            'job_description' => $this->selectedJob->requisition_description,
            'job_type' => $this->selectedJob->requisition_type,
            'job_arrangement' => $this->selectedJob->requisition_arrangement,
            'job_responsibilities' => $this->selectedJob->requisition_responsibilities,
            'job_qualifications' => $this->selectedJob->requisition_qualifications,
        ]);

        // Update requisition status to 'Ongoing'
        $this->selectedJob->status = 'In-Process';
        $this->selectedJob->save();

        session()->flash('success', 'Posted Successfully');
    }


    public function updateJob($id)
    {
        $this->selectedJob = JobPosting::findOrFail($id);

        $this->jobTitle = $this->selectedJob->job_title;
        $this->jobType = $this->selectedJob->job_type;
        $this->jobDescription = $this->selectedJob->job_description;
        $this->jobArrangement = $this->selectedJob->job_arrangement;
        $this->jobResponsibilities = $this->selectedJob->job_responsibilities;
        $this->jobQualifications = $this->selectedJob->job_qualifications;

        $this->showUpdateModal = true;
    }

    public function postUpdate()
    {
        $this->validate([
            'jobTitle' => 'required|string',
            'jobType' => 'required|string',
            'jobDescription' => 'required|string',
            'jobArrangement' => 'required|string',
            'jobResponsibilities' => 'required|string',
            'jobQualifications' => 'required|string',
        ]);

        if ($this->selectedJob) {
            $this->selectedJob->update([
                'job_title' => $this->jobTitle,
                'job_type' => $this->jobType,
                'job_description' => $this->jobDescription,
                'job_arrangement' => $this->jobArrangement,
                'job_responsibilities' => $this->jobResponsibilities,
                'job_qualifications' => $this->jobQualifications,
            ]);

            session()->flash('success', 'Job updated successfully!');
            $this->closeUpdateModal();
        }
    }

    public function closeUpdateModal()
    {
        $this->reset([
            'showUpdateModal',
            'selectedJob',
            'jobTitle',
            'jobType',
            'jobDescription',
            'jobArrangement',
            'jobResponsibilities',
            'jobQualifications',
        ]);

        $this->showUpdateModal = false;
    }
    public function removeJob($id)
    {
        $this->confirmRemoveId = $id;
        $this->showRemoveConfirmModal = true;
    }

    public function removeConfirmed()
    {
        $jobRequisition = Requisition::findOrFail($this->confirmRemoveId);
        $jobRequisition->status = 'Closed';
        $jobRequisition->save();
        $this->removeConfirmModal();
    }

    public function removeConfirmModal()
    {
        $this->showRemoveConfirmModal = false;
    }

    public function removeConfirmJob()
    {
        $this->selectedJob = JobPosting::findOrFail($this->confirmRemoveId);
        $this->selectedJob->status = "Removed";
        $this->selectedJob->save();
        $this->removeConfirmModal();

        session()->flash('success', 'Removed Successfully');
    }

    public function restoreJob($id)
    {
        $this->selectedJob = JobPosting::findOrFail($id);
        $this->selectedJob->status = "Posted";
        $this->selectedJob->save();

        session()->flash('success', 'Restore Jobs Successfully');
    }

    

    public function render()
    {
        $allRequisitions = Requisition::all();
        $allJobPostings = JobPosting::all();

        $postedIds = $allJobPostings->pluck('requisition_id')->toArray();
        $unpostedRequisitions = $allRequisitions->reject(fn($r) => in_array($r->id, $postedIds));

        $normalizedJobs = collect();
        if (in_array($this->statusFilter, ['Posted', 'Removed', 'All'])) {
            $normalizedJobs = collect(
                $allJobPostings
                    ->filter(fn($job) => $this->statusFilter === 'All' || $job->status === $this->statusFilter)
                    ->map(fn($job) => [
                        'id' => $job->id, 
                        'title' => $job->job_title,
                        'description' => $job->job_description,
                        'responsibility' => $job->job_responsibilities,
                        'qualification' => $job->job_qualifications,
                        'requisition_id' => $job->requisition_id,
                        'created_at' => $job->created_at,
                        'updated_at' => $job->updated_at,
                        'status' => $job->status,
                        'source' => 'job',
                    ])
            );
        }

        $normalizedRequisitions = collect();
        if (in_array($this->statusFilter, ['Open', 'All'])) {
            $normalizedRequisitions = collect(
                $unpostedRequisitions
                    ->filter(fn($req) => $req->status === 'Open')
                    ->map(fn($req) => [
                        'title' => $req->requisition_title,
                        'description' => $req->requisition_description,
                        'responsibility' => $req->requisition_responsibilities,
                        'qualification' => $req->requisition_qualifications,
                        'requisition_id' => $req->id,
                        'created_at' => $req->created_at,
                        'updated_at' => $req->updated_at,
                        'status' => $req->status,
                        'source' => 'requisition',
                    ])
            );
        }

        $combinedItems = $normalizedJobs->merge($normalizedRequisitions);

        if (!empty($this->search)) {
            $searchTerm = strtolower($this->search);

            $combinedItems = $combinedItems->filter(function ($item) use ($searchTerm) {
                return str_contains(strtolower($item['title']), $searchTerm)
                    || str_contains(strtolower("REQ-" . $item['requisition_id']), $searchTerm);
            });
        }

        
        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        $paginatedItems = new LengthAwarePaginator(
            $combinedItems->forPage($currentPage, $this->perPage)->values(),
            $combinedItems->count(),
            $this->perPage,
            $currentPage,
            [
                'path' => request()->url(),
                'pageName' => 'page',
            ]
        );

        return view('livewire.recruitment.job-postings', [
            'combinedItems' => $paginatedItems,
            'statusFilter' => $this->statusFilter,
        ]);
    }
}