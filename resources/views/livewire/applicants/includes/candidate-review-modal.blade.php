@if($showCandidateSelection)
<div @class('modal fade show d-block') tabindex="-1" style="background: rgba(0,0,0,0.5);">
    <div @class('modal-dialog modal-md modal-dialog-centered')>
        <div @class('modal-content')>
            <div @class('modal-header bg-primary text-white')>
                <h5 @class('modal-title')>Candidate Review</h5>
                <button type="button" @class('btn-close btn-close-white') wire:click="closeSetCandidate"></button>
            </div>

            <div @class('modal-body')>
                <form wire:submit.prevent="postCandidate">

                    <div>
                        <x-input-label for="schedule-date" :value="__('Schedule Date')" />
                        <x-text-input wire:model="scheduleDate"  type="date" id="schedule-date" required />
                        <x-input-error field="scheduleDate" />
                    </div>

                    <div>
                        <x-input-label for="schedule-time" :value="__('Schedule Time')" />
                        <x-text-input wire:model="scheduleTime"  type="time" id="schedule-time" required />
                        <x-input-error field="scheduleTime" />
                    </div>

                     <div @class(['modal-footer'])>
                        <button type="button" @class(['btn', 'btn-secondary']) wire:click="closeSetCandidate">Close</button>
                        <x-button-primary>Set</x-button-primary>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endif