{{-- Orientation Plan Scheduling Card --}}
<div class="card border rounded shadow-sm mb-4">
    <div class="card-header bg-white border-bottom">
        <h5 class="mb-0">🗓️ Orientation Schedule</h5>
        <p class="text-muted mb-0">Set the orientation date and time for new hires</p>
    </div>

    <div class="card-body">
        <form>
            <div class="mb-3">
                <label for="orientation_date" class="form-label">Orientation Date</label>
                <input type="date" class="form-control" id="orientation_date" name="orientation_date">
            </div>

            <div class="mb-3">
                <label for="orientation_time" class="form-label">Orientation Time</label>
                <input type="time" class="form-control" id="orientation_time" name="orientation_time">
            </div>

            <div class="mb-3">
                <label for="orientation_notes" class="form-label">Additional Notes</label>
                <textarea class="form-control" id="orientation_notes" name="orientation_notes" rows="3" placeholder="Include location, dress code, or agenda..."></textarea>
            </div>

            <button type="submit" class="btn btn-primary">
                Save Schedule
            </button>
        </form>
    </div>
</div>