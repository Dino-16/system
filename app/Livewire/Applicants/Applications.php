<?php

namespace App\Livewire\Applicants;

use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use App\Models\Applicant_Management\Application;
use App\Models\Applicant_Management\ResumeData;

class Applications extends Component
{
    use WithPagination, WithoutUrlPagination; 

    public $search = ''; 

    public $statusFilter = 'All';

    public $showFilteringModal = false;

    public $filterApplicant;

    public $first_name, $last_name, $middle_name, $suffix;
    public $address, $email, $phone;
    public $age, $gender, $birth_date, $civil_status;
    public $height, $weight, $skills, $education, $experience;
    public $status;


    public function reviewResume($id)
    {
        $this->filterApplicant = Application::findOrFail($id);
        $this->showFilteringModal = true;
    }

    public function closeModal()
    {
        $this->showFilteringModal = false;
    }

    protected $rules = [
        'age' => 'required|integer|min:0',
        'gender' => 'required|string|in:Male,Female,Other',
        'birth_date' => 'required|date',
        'civil_status' => 'required|string|in:Single,Married,Widowed,Separated',
        'height' => 'required|numeric|min:0',
        'weight' => 'required|numeric|min:0',
        'skills' => 'required|string|max:1000',
        'education' => 'required|string|max:1000',
        'experience' => 'required|string|max:2000',
        'status' => 'required|string|in:Good,Excellent,Bad',
        'first_name' => 'nullable|string|max:255',
        'last_name' => 'nullable|string|max:255',
        'middle_name' => 'nullable|string|max:255',
        'suffix' => 'nullable|string|max:50',
        'email' => 'nullable|email|max:255',
        'phone' => 'nullable|string|max:20',
        'address' => 'nullable|string|max:500',
    ];

    public function saveReview()
    {
        $validated = $this->validate();

        ResumeData::create([
            'applicant_job_id'       => $this->filterApplicant->job_id,
            'applicant_job_title'    => $this->filterApplicant->job_title,
            'applicant_first_name'   => $this->filterApplicant->applicant_first_name,
            'applicant_last_name'    => $this->filterApplicant->applicant_last_name,
            'applicant_middle_name'  => $this->filterApplicant->applicant_middle_name,
            'applicant_suffix'       => $this->filterApplicant->applicant_suffix,
            'applicant_address'      => $this->filterApplicant->applicant_address,
            'applicant_email'        => $this->filterApplicant->applicant_email,
            'applicant_phone'        => $this->filterApplicant->applicant_phone,
            'applicant_age'          => $validated['age'],
            'applicant_gender'       => $validated['gender'],
            'applicant_birth_date'   => $validated['birth_date'],
            'applicant_civil_status' => $validated['civil_status'],
            'applicant_height'       => $validated['height'],
            'applicant_weight'       => $validated['weight'],
            'applicant_skills'       => $validated['skills'],
            'applicant_education'    => $validated['education'],
            'applicant_experience'   => $validated['experience'],
            'ratings'                => $validated['status'],
        ]);

        $this->filterApplicant->status = 'Filtered';
        $this->filterApplicant->save();

        session()->flash('success', 'Applicant successfully added to filtered list.');
        $this->closeModal();
    }

    public function render()
    {   
        $statusCounts = [
            'Not Filtered' => Application::where('status', 'Not Filtered')->count(),
            'Filtered' => Application::where('status', 'Filtered')->count(),
            'All' => Application::count(),
        ];

        $query = Application::latest();


        if ($this->statusFilter !== 'All') {
            $query->where('status', $this->statusFilter);
        }

        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('applicant_last_name', 'like', '%' . $this->search . '%')
                ->orWhere('applicant_first_name', 'like', '%' . $this->search . '%')
                ->orWhere('applicant_middle_name', 'like', '%' . $this->search . '%')
                ->orWhere('applicant_suffix_name', 'like', '%' . $this->search . '%')
                ->orWhere('job_title', 'like', '%' . $this->search . '%')
                ->orWhere('applicant_email', 'like', '%' . $this->search . '%');
            });
        }

        $applicants = $query->paginate(3);

        return view('livewire.applicants.applications', [
            'applicants' => $applicants,
            'statusCounts' => $statusCounts
        ]);
    }
}
