<div>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">My Room Requests</h5>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#requestRoomModal">
            <i class="bi bi-plus-circle me-2"></i>Request Room
        </button>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Requested At</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($requests as $req)
                        <tr>
                            <td class="text-nowrap">{{ $req->title }}</td>
                            <td>{{ $req->category ?? '—' }}</td>
                            <td class="text-capitalize">{{ $req->status }}</td>
                            <td>{{ $req->created_at->format('Y-m-d H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">No requests yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
