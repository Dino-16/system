<div class="row row-cols-1 row-cols-md-5 g-3">
    @foreach ($statusCounts as $status => $count)
        <div class="col">
            <div class="card p-3 shadow-sm border-0 h-100">
                {{-- Icon --}}
                <div class="mb-2">
                    @switch($status)
                        @case('Open')
                            <i class="bi bi-folder2-open text-primary fs-3"></i>
                            @break
                        @case('In-Progress')
                            <i class="bi bi-hourglass-split text-warning fs-3"></i>
                            @break
                        @case('Closed')
                            <i class="bi bi-check-circle-fill text-success fs-3"></i>
                            @break
                        @case('Draft')
                            <i class="bi bi-journal-text text-secondary fs-3"></i>
                            @break
                        @case('All')
                            <i class="bi bi-collection-fill text-dark fs-3"></i>
                            @break
                    @endswitch
                </div>

                <div class="ps-2">
                                    {{-- Count --}}
                    <div class="fw-semi fs-4">
                        {{ $count }}
                    </div>

                    {{-- Label --}}
                    <div class="text-muted small">
                        {{ $status }} requisitions
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>