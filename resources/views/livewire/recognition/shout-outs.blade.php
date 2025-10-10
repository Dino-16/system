<div>
    <x-alert-success />

    <div @class('row pt-1')>
        <div @class('col-md-7')>
            <div @class('card p-5')>
                {{-- header --}}
                <div @class(['mb-5'])>
                    <h2>Create New Shout-out</h2>
                </div>

                <form wire:submit.prevent="submitRecognition">
                    <div class="row">
                        {{-- Name --}}
                        <div class="col-md-12">
                            <div class="mb-5">
                                <label for="name">Name</label>
                                <input type="text" id="name" class="form-control" wire:model.defer="c_name">
                                @error('c_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        {{-- Recognition type --}}
                        <div class="col-md-6">
                            <div class="mb-5">
                                <label for="type">Recognition Type</label>
                                <input type="text" id="type" class="form-control" wire:model.defer="c_type">
                                @error('c_type') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        {{-- Date --}}
                        <div class="col-md-6">
                            <div class="mb-5">
                                <label for="date">Date</label>
                                <input type="date" id="date" class="form-control" wire:model.defer="c_date">
                                @error('c_date') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        {{-- Message --}}
                        <div class="col-md-12">
                            <div class="mb-5">
                                <label for="message">Message</label>
                                <textarea id="message" class="form-control" style="height: 150px;" wire:model.defer="c_message"></textarea>
                                @error('c_message') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        {{-- Submit Button --}}
                        <div class="col-md-12">
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary text-white text-center p-2">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>


    <div class="col-md-5">
        {{-- Recognition Header --}}
        <div class="mb-5">
            <h2>Recent Recognition</h2>
        </div>

        <div class="row">
            <div class="col-md-12">
                @forelse ($recognitions as $recognition)
                    <div class="row align-items-center border p-3 mb-3 rounded">
                        {{-- Employee Image (placeholder or dynamic) --}}
                        @php
                            $firstLetter = strtoupper(substr($recognition->name, 0, 1));
                        @endphp

                        <div class="col-sm-2 d-flex justify-content-center align-items-center">
                            <div class="rounded-circle bg-primary text-white d-flex justify-content-center align-items-center"
                                style="width: 80px; height: 80px; font-size: 32px; font-weight: bold;">
                                {{ $firstLetter }}
                            </div>
                        </div>

                        {{-- Recognition Details --}}
                        <div class="col-sm-7">
                            <h5 class="mb-1">{{ $recognition->name }}</h5>
                            <h6 class="text-muted mb-2">{{ $recognition->type }}</h6>
                            <p class="mb-1">{{ $recognition->message }}</p>
                            <p class="text-muted small">{{ \Carbon\Carbon::parse($recognition->date)->format('F j, Y') }}</p>
                        </div>

                        {{-- Actions --}}
                        <div class="col-sm-3 d-flex flex-column gap-2">
                            <button class="btn btn-outline-primary btn-sm w-100" wire:click="edit({{ $recognition->id }})">Edit</button>
                            <button class="btn btn-danger btn-sm w-100" wire:click="delete({{ $recognition->id }})">Delete</button>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-muted">No latest recognitions yet.</div>
                @endforelse
            </div>
        </div>
    </div>
    </div>

    {{-- Livewire-only Edit Overlay Panel (no JS) --}}
    @if($showEdit)
        <div style="position: fixed; inset: 0; background: rgba(0,0,0,.5); display: flex; align-items: center; justify-content: center; z-index: 1050;">
            <div class="card" style="width: 100%; max-width: 720px;">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Edit Shout-out</h5>
                    <button type="button" class="btn btn-sm btn-outline-secondary" wire:click="cancelEdit">Close</button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="edit_name" class="form-label">Name</label>
                                <input type="text" id="edit_name" class="form-control" wire:model.defer="name">
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_type" class="form-label">Recognition Type</label>
                                <input type="text" id="edit_type" class="form-control" wire:model.defer="type">
                                @error('type') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_date" class="form-label">Date</label>
                                <input type="date" id="edit_date" class="form-control" wire:model.defer="date">
                                @error('date') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="edit_message" class="form-label">Message</label>
                                <textarea id="edit_message" class="form-control" style="height: 150px;" wire:model.defer="message"></textarea>
                                @error('message') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end gap-2">
                    <button class="btn btn-secondary" wire:click="cancelEdit">Cancel</button>
                    <button class="btn btn-primary" wire:click="updateRecognition">Update</button>
                </div>
            </div>
        </div>
    @endif