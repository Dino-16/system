<?php

namespace App\Livewire\Performance;

use Livewire\Component;
use App\Models\Performance_Management\Evaluation;

class EvaluationForm extends Component
{
    public $full_name, $review_period, $job_title, $department, $reviewer_name;
    public $competencies = [];
    public $strengths, $improvements, $development_plan;
    public $employee_rating, $confidence_level;

    public function mount()
    {
        // Initialize competencies with default values
        foreach (['Communication', 'Teamwork', 'Problem Solving', 'Adaptability', 'Leadership', 'Initiative'] as $key) {
            $this->competencies[$key] = null;
        }
    }

    public function submitEvaluation()
    {
        $this->validate([
            'full_name' => 'required|string|max:100',
            'review_period' => 'required|in:Q1,Q2,Q3,Q4',
            'job_title' => 'required|string|max:100',
            'department' => 'required|string|max:100',
            'reviewer_name' => 'required|string|max:100',
            'competencies.*' => 'required|integer|min:1|max:5',
            'strengths' => 'nullable|string|max:1000',
            'improvements' => 'nullable|string|max:1000',
            'development_plan' => 'nullable|string|max:1000',
            'employee_rating' => 'required|integer|min:1|max:5',
            'confidence_level' => 'required|integer|min:1|max:5',
        ]);

        Evaluation::create([
            'full_name' => $this->full_name,
            'review_period' => $this->review_period,
            'job_title' => $this->job_title,
            'department' => $this->department,
            'reviewer_name' => $this->reviewer_name,
            'competencies' => json_encode($this->competencies),
            'strengths' => $this->strengths,
            'improvements' => $this->improvements,
            'development_plan' => $this->development_plan,
            'employee_rating' => $this->employee_rating,
            'confidence_level' => $this->confidence_level,
        ]);

        session()->flash('success', 'Evaluation submitted successfully.');
        $this->reset();
        $this->mount(); 
    }

    public function render()
    {
        return view('livewire.performance.evaluation-form');
    }
}
