<?php

namespace App\Livewire\Onboarding;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class NewHires extends Component
{
    use WithPagination;

    public $employees = [];
    public $search = '';
    public $perPage = 10;

    public function mount()
    {
        $response = Http::get('http://hr4.jetlougetravels-ph.com/api/employees');

        if ($response->successful() && is_array($response->json())) {
            $this->employees = $response->json();
        } else {
            $this->employees = []; // fallback if API fails
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        // Always convert to collection for safe pagination
        $collection = collect($this->employees);

        // Search filter
        $filtered = $collection->filter(function ($employee) {
            $search = strtolower($this->search);
            return str_contains(strtolower($employee['name'] ?? ''), $search)
                || str_contains(strtolower($employee['email'] ?? ''), $search)
                || str_contains(strtolower($employee['role'] ?? ''), $search)
                || str_contains(strtolower($employee['department'] ?? ''), $search);
        });

        // Paginate (client-side)
        $employees = $this->paginateCollection($filtered);

        return view('livewire.onboarding.new-hires', compact('employees'));
    }

    private function paginateCollection(Collection $items)
    {
        $page = $this->page ?? 1;
        $perPage = $this->perPage;

        $items = $items instanceof Collection ? $items : collect($items);
        $paginatedItems = $items->forPage($page, $perPage)->values();

        return new LengthAwarePaginator(
            $paginatedItems,
            $items->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );
    }
}
