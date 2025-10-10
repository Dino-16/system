<div class="modal fade" id="editRecognitionModal" tabindex="-1" aria-labelledby="editRecognitionModalLabel" aria-hidden="true" wire:ignore.self>
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editRecognitionModalLabel">Edit Shout-out</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="cancelEdit"></button>
      </div>
      <div class="modal-body">
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
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="cancelEdit">Cancel</button>
        <button type="button" class="btn btn-primary" wire:click="updateRecognition">Update</button>
      </div>
    </div>
  </div>
</div>
