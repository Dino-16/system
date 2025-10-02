<?php

namespace App\Livewire\Recognition;

use Livewire\Component;
use App\Models\Social_Recognition\Recognition;

class ShoutOuts extends Component
{   
    public $name;
    public $type;
    public $date;
    public $message;

    public function submitRecognition()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'date' => 'required|date',
            'message' => 'required|string|max:1000',
        ]);

        Recognition::create([
            'name' => $this->name,
            'type' => $this->type,
            'date' => $this->date,
            'message' => $this->message,
        ]);

        $this->reset(['name', 'type', 'date', 'message']);
        session()->flash('success', 'Recognition submitted successfully.');
    }

    public function render()
    {
        $recognitions = Recognition::latest()->take(5)->get(); // Show latest 5

        return view('livewire.recognition.shout-outs', [
            'recognitions' => $recognitions,
        ]);

    }
}
