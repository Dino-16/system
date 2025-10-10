<?php

namespace App\Livewire\Recognition;

use Livewire\Component;
use App\Models\Social_Recognition\Recognition;

class ShoutOuts extends Component
{   
    public ?Recognition $recognition = null;
    public bool $showEdit = false;
    // Edit fields (used by the edit overlay)
    public $name;
    public $type;
    public $date;
    public $message;

    // Create fields (used by the left create form)
    public $c_name;
    public $c_type;
    public $c_date;
    public $c_message;

    public function submitRecognition()
    {
        // Validate create-only fields
        $this->validate([
            'c_name' => 'required|string|max:255',
            'c_type' => 'required|string|max:255',
            'c_date' => 'required|date',
            'c_message' => 'required|string|max:1000',
        ]);

        // Always create a new record from create fields
        Recognition::create([
            'name' => $this->c_name,
            'type' => $this->c_type,
            'date' => $this->c_date,
            'message' => $this->c_message,
        ]);

        session()->flash('success', 'Recognition submitted successfully.');

        // Only reset the create fields, do not touch edit state
        $this->reset(['c_name', 'c_type', 'c_date', 'c_message']);
    }

    public function render()
    {
        // Show the most recently updated records so edits bubble to the top
        $recognitions = Recognition::orderByDesc('updated_at')->take(5)->get();

        return view('livewire.recognition.shout-outs', [
            'recognitions' => $recognitions,
        ]);

    }

    public function edit($id)
    {
        $this->recognition = Recognition::findOrFail($id);

        $this->name = $this->recognition->name;
        $this->type = $this->recognition->type;
        // Ensure proper format for HTML date input
        $this->date = optional($this->recognition->date) instanceof \Carbon\Carbon
            ? $this->recognition->date->format('Y-m-d')
            : (is_string($this->recognition->date) ? \Carbon\Carbon::parse($this->recognition->date)->format('Y-m-d') : null);
        $this->message = $this->recognition->message;

        // Show Livewire edit panel (no JS)
        $this->showEdit = true;
    }

    public function cancelEdit()
    {
        $this->reset(['recognition', 'name', 'type', 'date', 'message']);
        $this->showEdit = false;
    }

    public function delete($id)
    {
        $model = Recognition::findOrFail($id);
        $model->delete();

        if ($this->recognition && $this->recognition->id === $id) {
            $this->reset(['recognition', 'name', 'type', 'date', 'message']);
        }

        session()->flash('success', 'Recognition deleted successfully.');
    }

    public function updateRecognition()
    {
        if (!$this->recognition) {
            abort(400, 'No recognition selected for update.');
        }

        $this->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'date' => 'required|date',
            'message' => 'required|string|max:1000',
        ]);

        $this->recognition->update([
            'name' => $this->name,
            'type' => $this->type,
            'date' => $this->date,
            'message' => $this->message,
        ]);

        session()->flash('success', 'Recognition updated successfully.');

        $this->reset(['recognition', 'name', 'type', 'date', 'message']);
        $this->showEdit = false;
    }
}
