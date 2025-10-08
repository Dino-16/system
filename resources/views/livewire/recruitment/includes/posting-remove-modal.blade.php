@if($showRemoveConfirmModal)
    <div 
        @class('modal fade show d-block') 
        tabindex="-1" 
        style="background: rgba(0,0,0,0.5);"
    >
        <div @class('modal-dialog modal-md modal-dialog-centered')>
            <div @class('modal-content border-0 shadow rounded-2')>

                {{-- Header --}}
                <div @class('modal-header bg-primary text-white')>
                    <h5 @class('modal-title fw-semibold')>
                        <i @class('bi bi-briefcase-fill me-2')></i>
                        Remove Confirmation
                    </h5>
                    <button 
                        type="button" 
                        @class('btn-close btn-close-white') 
                        wire:click="removeConfirmModal"></button>
                </div>

                {{-- Body --}}
                <div @class('modal-body')>
                    <p>Are you sure you want to remove this job ?</p>
                </div>

                {{-- Footer --}}
                <div @class('modal-footer bg-light border-0')>
                    <button type="button" class="btn btn-secondary" wire:click="removeConfirmModal">Cancel</button>
                    <button type="button" class="btn btn-primary" wire:click="removeConfirmJob">Yes, Remove</button>
                </div>

            </div>
        </div>
    </div>
@endif
