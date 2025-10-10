<?php

namespace App\Livewire\Recognition;

use Livewire\Component;
use App\Models\Social_Recognition\Recognition;
use Livewire\WithPagination;

class ShoutoutRecords extends Component
{
    use WithPagination;

    public $search = '';

    // Edit form fields
    public $selectedId = null;
    public $name = '';
    public $type = '';
    public $date = '';
    public $message = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function rules()
    {
        return [
            'name' => ['required','string','max:255'],
            'type' => ['required','string','max:255'],
            'date' => ['required','date'],
            'message' => ['required','string'],
        ];
    }

    public function edit($id)
    {
        $rec = Recognition::findOrFail($id);
        $this->selectedId = $rec->id;
        $this->name = $rec->name;
        $this->type = $rec->type;
        $this->date = $rec->date;
        $this->message = $rec->message;
    }

    public function cancelEdit()
    {
        $this->reset(['selectedId','name','type','date','message']);
    }

    public function updateRecognition()
    {
        $this->validate();
        $rec = Recognition::findOrFail($this->selectedId);
        $rec->update([
            'name' => $this->name,
            'type' => $this->type,
            'date' => $this->date,
            'message' => $this->message,
        ]);

        session()->flash('success', 'Recognition updated successfully.');
        $this->cancelEdit();
    }

    public function delete($id)
    {
        $rec = Recognition::findOrFail($id);
        $rec->delete();
        session()->flash('success', 'Recognition deleted.');
        // refresh pagination if needed
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