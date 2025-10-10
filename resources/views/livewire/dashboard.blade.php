<div class="container-fluid">

    {{-- Summary Cards --}}
    <div class="row row-cols-1 row-cols-md-4 g-3 pb-3">
        <div class="col">
            <div class="card p-3 h-100 shadow-sm border-0">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <i class="bi bi-briefcase-fill text-primary fs-2"></i>
                </div>
                <div class="ps-1">
                    <h6 class="card-title fs-5 fw-semibold">{{ $totalPostedJobs }}</h6>
                    <p class="text-secondary mb-0">All posted jobs</p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card p-3 h-100 shadow-sm border-0">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <i class="bi bi-person-lines-fill text-info fs-2"></i>
                </div>
                <div class="ps-1">
                    <h6 class="card-title fs-5 fw-semibold">{{ $totalApplicants }}</h6>
                    <p class="text-secondary mb-0">All applicants</p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card p-3 h-100 shadow-sm border-0">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <i class="bi bi-person-badge-fill text-warning fs-2"></i>
                </div>
                <div class="ps-1">
                    <h6 class="card-title fs-5 fw-semibold">{{ $totalCandidates }}</h6>
                    <p class="text-secondary mb-0">All candidates</p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card p-3 h-100 shadow-sm border-0">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <i class="bi bi-people-fill text-success fs-2"></i>
                </div>
                <div class="ps-1">
                    <h6 class="card-title fs-5 fw-semibold">{{ $totalEmployee }}</h6>
                    <p class="text-secondary mb-0">All employees</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Interview Pipeline --}}
    <div class="row pb-3">
        <div class="col-md-5">
        </div>
        <div class="col-md-3">
            @forelse ($recognitions as $recognition)
                <div class="row card d-flex justify-content-center flex-column align-items-center border p-3 mb-3 h-100 rounded">
                    {{-- Employee Image (placeholder or dynamic) --}}
                    @php
                        $firstLetter = strtoupper(substr($recognition->name, 0, 1));
                    @endphp
                        <div class="rounded-circle bg-primary text-white d-flex justify-content-center align-items-center mb-3"
                            style="width: 80px; height: 80px; font-size: 32px; font-weight: bold;">
                            {{ $firstLetter }}
                        </div>

                    {{-- Recognition Details --}}
                    <div class="col-sm-12 text-center">
                        <h5 class="mb-1">{{ $recognition->name }}</h5>
                        <h6 class="text-muted mb-2">{{ $recognition->type }}</h6>
                        <p class="mb-1">{{ $recognition->message }}</p>
                        <p class="text-muted small">{{ \Carbon\Carbon::parse($recognition->date)->format('F j, Y') }}</p>
                    </div>

                </div>
            @empty
                <div class="text-center text-muted">No latest recognitions yet.</div>
            @endforelse
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border rounded-3 p-4 mx-auto">
                <h2 class="text-center fs-5 fw-bold text-secondary mb-4">
                    <i class="bi bi-diagram-3-fill me-2 text-secondary"></i> Interview Pipeline
                </h2>
                <div class="d-grid gap-3">
                    @foreach($statusCountCandidates as $status => $count)
                        <div class="d-flex justify-content-between align-items-center border-bottom pb-2">
                            <span class="text-muted fw-medium">{{ $status }}</span>
                            <span class="fw-semibold">{{ $count }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- Live Date & Time --}}
    <div class="row">
        <div class="col-md-8">
        </div>
        <div class="col-md-4">
            <div wire:poll.1000ms="updateDateTime" class="card shadow-sm border rounded-4 p-4 text-center">
                <div class="mb-2">
                    <i class="bi bi-clock-history text-primary fs-2"></i>
                </div>
                <div class="text-muted small" style="letter-spacing:0.5px;">
                    {{ \Carbon\Carbon::parse($currentDateTime)->format('l') }}
                </div>
                <div class="d-flex justify-content-between mt-2 px-2">
                    <div class="fw-semibold text-start">
                        {{ \Carbon\Carbon::parse($currentDateTime)->format('F j, Y') }}
                    </div>
                    <div class="fw-semibold text-end">
                        {{ \Carbon\Carbon::parse($currentDateTime)->format('h:i A') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>