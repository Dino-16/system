{{-- Application Status Cards --}}
<div class="row row-cols-1 row-cols-md-3 g-3 mb-4">
    @foreach ($statusCounts as $status => $count)
        <div class="col">
            <div class="card p-3 shadow-sm border-0 h-100">
                <div class="card-body text-start">
                    {{-- Icon --}}
                    @switch($status)
                        @case('Not Filtered')
                            <i class="bi bi-slash-circle text-danger fs-3"></i>
                            @break
                        @case('Filtered')
                            <i class="bi bi-filter-circle text-success fs-3"></i>
                            @break
                        @case('All')
                            <i class="bi bi-collection text-primary fs-3"></i>
                            @break
                    @endswitch

                    <div @class('ps-2')>
                        {{-- Count --}}
                        <div class="fw-bold fs-4">
                            {{ $count }}
                        </div>

                        {{-- Label --}}
                        <div class="text-muted small">
                            {{ $status }} applications
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>