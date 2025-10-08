<!-- Request Room Modal -->
<div class="modal fade" id="requestRoomModal" tabindex="-1" aria-labelledby="requestRoomModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="requestRoomModalLabel">New Document Upload</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row g-4">
          <div class="col-lg-12">
            <div class="card shadow-sm border-0">
              <div class="card-body">
                <form id="document-upload-form" class="row g-3" method="POST" action="{{ route('facilities-requests.store') }}" enctype="multipart/form-data">
                  @csrf
                  <div class="col-md-6">
                    <label class="form-label">Title<span class="text-danger"></span></label>
                    <input type="text" name="title" class="form-control" required>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">File<span class="text-danger"></span></label>
                    <input type="file" name="file" class="form-control">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Category</label>
                    <select name="category_id" class="form-select" id="category_id">
                      <option value="">-- Select Category --</option>
                      <option value="Contracts">Contracts</option>
                      <option value="Correspondence">Correspondence</option>
                      <option value="Invoices">Invoices</option>
                      <option value="Legal Documents">Legal Documents</option>
                      <option value="Policies">Policies</option>
                      <option value="Procedures">Procedures</option>
                      <option value="Reports">Reports</option>
                      <option value="Travel Documents">Travel Documents</option>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Or New Category</label>
                    <input type="text" name="new_category" class="form-control" placeholder="e.g., Invoices">
                  </div>
                  <div class="col-12">
                    <label class="form-label">Description</label>
                    <textarea name="description" rows="3" class="form-control" placeholder="Optional description..."></textarea>
                  </div>
                  <div class="col-12 d-flex gap-2">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-upload me-2"></i>Upload Document</button>
                    <button type="reset" class="btn btn-outline-secondary">Reset Form</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
