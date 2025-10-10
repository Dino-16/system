<div>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">Room Requests</h3>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#requestRoomModal">
            <i class="bi bi-plus-circle me-2"></i>Request Room
        </button>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($requests->isEmpty())
        <div class="text-center text-muted py-5">
            <i class="bi bi-inbox" style="font-size: 2rem;"></i>
            <p class="mt-2 mb-0">No requests yet.</p>
        </div>
    @else
        <div class="row g-3">
            @foreach($requests as $req)
                <div class="col-md-4 col-sm-6">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body">
                            <h6 class="card-title mb-1 text-primary fw-semibold">{{ $req->title }}</h6>
                            <p class="text-muted small mb-2">
                                <i class="bi bi-tag me-1"></i>{{ $req->category ?? 'Uncategorized' }}
                            </p>

                            <span class="badge 
                                @class([
                                    'bg-success' => $req->status === 'approved',
                                    'bg-warning text-dark' => $req->status === 'pending',
                                    'bg-danger' => $req->status === 'rejected',
                                    'bg-secondary' => !in_array($req->status, ['approved','pending','rejected'])
                                ])">
                                {{ ucfirst($req->status) }}
                            </span>

                            <div class="mt-3 small text-muted">
                                <i class="bi bi-clock me-1"></i>
                                Requested at: {{ $req->created_at->format('Y-m-d H:i') }}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
