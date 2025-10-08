<div>
<div wire:poll.1000ms="updateDateTime" class="d-flex align-items-center justify-content-end mb-4">
    <div class="bg-white border rounded shadow-sm px-4 py-2 d-flex align-items-center gap-2">
        <i class="bi bi-clock-history text-primary fs-4"></i>
        <span class="fw-semibold fs-5" style="letter-spacing:1px;">
            {{ $currentDateTime }}
        </span>
    </div>
</div>

<div class="row g-3 pb-5">
    {{-- Requisition Card --}}
    <div class="col-12 col-md-6 col-lg-3">
        <div class="card p-3 h-100">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <i class="bi bi-archive text-warning fs-4"></i>
            </div>
            <div class="ps-1 card-title">
                <h6 class="card-title fs-5 fw-medium">{{ $totalRequisitions }}</h6>
                <p class="text-secondary mb-0">All open requisitions</p>
            </div>
        </div>
    </div>

    {{-- Posted Jobs Card --}}
    <div class="col-12 col-md-6 col-lg-3">
        <div class="card p-3 h-100">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <i class="bi bi-archive text-warning fs-4"></i>
            </div>
            <div class="ps-1">
                <h6 class="card-title fs-5 fw-medium">{{ $totalPostedJobs }}</h6>
                <p class="text-secondary mb-0">All posted jobs</p>
            </div>
        </div>
    </div>

    {{-- Add more cards here --}}
</div>
</div>