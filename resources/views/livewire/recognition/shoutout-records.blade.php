<div>
    {{-- recognition list --}}
<div class="pt-3">

    <div class="d-flex justify-content-between align-items-center">
        {{-- Search Bar --}}
        <div class="mb-3 w-25">
            <x-text-input type="search" wire:model.live.debounce.3s="search" placeholder="Search..." />
        </div>

    </div>

    {{-- Table Title --}}
    <div class="p-5 bg-white rounded border rounded-bottom-0 border-bottom-0">
        <div>
            <h3>All Recognitions</h3>
            <p class="text-secondary mb-0">Overview of recent awards, milestones, and appreciations</p>
        </div>
    </div>

    {{-- Table --}}
    <div class="table-responsive border rounded bg-white px-5 rounded-top-0 border-top-0">
        <table class="table">
            <thead>
                <tr class="bg-dark">
                    <th class="text-secondary fw-normal" scope="col">Name</th>
                    <th class="text-secondary fw-normal" scope="col">Type</th>
                    <th class="text-secondary fw-normal" scope="col">Date</th>
                    <th class="text-secondary fw-normal" scope="col">Message</th>
                    <th class="text-secondary fw-normal" scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recognitions as $recognition)
                    <tr>
                        <td class="text-nowrap">{{ $recognition->name }}</td>
                        <td class="text-capitalize">{{ $recognition->type }}</td>
                        <td class="text-nowrap">{{ \Carbon\Carbon::parse($recognition->date)->format('F j, Y') }}</td>
                        <td class="text-truncate" style="max-width: 300px;">{{ $recognition->message }}</td>
                        <td class="text-nowrap">
                            <button type="button" class="btn btn-default border btn-sm"
                                    wire:click="edit({{ $recognition->id }})"
                                    data-bs-toggle="modal" data-bs-target="#editRecognitionModal"
                                    title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <button type="button" class="btn btn-danger border btn-sm" wire:click="delete({{ $recognition->id }})" title="Delete">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">No recognitions found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        <div>
            {{ $recognitions->links() }}
        </div>
    </div>

    {{-- Edit Modal --}}
    @include('livewire.recognition.includes.edit-modal')

</div>
</div>