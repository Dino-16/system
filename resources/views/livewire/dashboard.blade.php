<div>
    <div @class(['row', 'g-3', 'pb-5'])>

        @foreach ($totalRequisitions as $total => $count)
            <div @class(['col-6', 'col-md-3'])>
                <div @class(['card', 'border', 'shadow-sm', 'p-3'])>
                    <div @class(['d-flex', 'justify-content-between', 'align-items-center', 'mb-2'])>
                        <h6 @class(['text-secondary', 'm-0'])>{{ ucfirst($total) }}</h6>
                        <i @class(['bi', 'bi-archive', 'text-warning', 'fs-4'])></i>
                    </div>
                    <div @class(['ps-3'])>
                        <small @class(['fw-medium', 'fs-5'])>{{ $count }}</small>
                        <p @class(['text-secondary'])>All open requisitions</p>
                    </div>
                </div>
            </div>
        @endforeach

        @foreach ($totalPostedJobs as $total => $count)
            <div @class(['col-6', 'col-md-3'])>
                <div @class(['card', 'border', 'shadow-sm', 'p-3'])>
                    <div @class(['d-flex', 'justify-content-between', 'align-items-center', 'mb-2'])>
                        <h6 @class(['text-secondary', 'm-0'])>{{ ucfirst($total) }}</h6>
                        <i @class(['bi', 'bi-archive', 'text-warning', 'fs-4'])></i>
                    </div>
                    <div @class(['ps-3'])>
                        <small @class(['fw-medium', 'fs-5'])>{{ $count }}</small>
                        <p @class(['text-secondary'])>All posted jobs</p>
                    </div>
                </div>
            </div>
        @endforeach

</div>