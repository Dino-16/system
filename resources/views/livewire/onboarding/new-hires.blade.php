<div class="pt-3">

    {{-- Search Bar --}}
    <div class="mb-3 w-25">
        <x-text-input type="search" wire:model.live.debounce.3s="search" placeholder="Search by name or position..." />
    </div>

    <div @class('p-5 bg-white rounded border rounded-bottom-0 border-bottom-0')>
        <div>
            <h3>All New Hires</h3>
            <p @class('text-secondary mb-0')>
                Overview of pending, in progress, completed requirements of new hires
            </p>
        </div>
    </div>

    {{-- Table --}}
    <div @class('table-responsive border rounded bg-white px-5 rounded-top-0 border-top-0')>
        <table @class('table')>
            <thead>
                <tr @class('bg-dark')>
                    <th @class('text-secondary fw-normal') scope="col">Name</th>
                    <th @class('text-secondary fw-normal') scope="col">Position</th>
                    <th @class('text-secondary fw-normal') scope="col">Department</th>
                    <th @class('text-secondary fw-normal') scope="col">Contract Signing</th>
                    <th @class('text-secondary fw-normal') scope="col">HR Documents</th>
                    <th @class('text-secondary fw-normal') scope="col">Training Modules</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($employees as $employee)
                    <tr>
                        <td @class('text-nowrap')>{{ $employee['name'] ?? '—' }}</td>
                        <td @class('text-truncate')>{{ $employee['role'] ?? '—' }}</td>
                        <td @class('text-capitalize')>{{ $employee['department'] ?? 'Not Integrated' }}</td>
                        <td>
                            <span @class('badge rounded-pill px-3 py-2 bg-secondary')>
                                    {{ 'Completed' }}
                            </span>
                        </td>
                        <td @class('text-capitalize')>{{ 'Not Integrated' }}</td>
                        <td @class('text-capitalize')>{{ 'Not Integrated' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" @class('text-center text-muted')>
                            Not integrated
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        @if ($employees instanceof \Illuminate\Pagination\LengthAwarePaginator)
            <div class="card-footer border-0">
                {{ $employees->links() }}
            </div>
        @endif

    </div>

</div>
