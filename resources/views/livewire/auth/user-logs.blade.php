<div @class('pt-3')>

    {{-- Table Header --}}
    <div @class('p-5 bg-white rounded border rounded-bottom-0 border-bottom-0')>
        <div>
            <h3>Login History</h3>
            <p @class('text-secondary mb-0')>
                Overview of user login activity and IP status
            </p>
        </div>
    </div>

    {{-- Table --}}
    <div @class('table-responsive border rounded bg-white px-5 rounded-top-0 border-top-0')>
        <table @class('table')>
            <thead>
                <tr @class('bg-dark text-white')>
                    <th @class('text-secondary fw-normal') scope="col">User</th>
                    <th @class('text-secondary fw-normal') scope="col">Date & Time</th>
                    <th @class('text-secondary fw-normal') scope="col">IP Address</th>
                    <th @class('text-secondary fw-normal') scope="col">User Agent</th>
                    <th @class('text-secondary fw-normal') scope="col">Status</th>
                    <th @class('text-secondary fw-normal') scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($logs as $log)
                    <tr>
                        <td @class('text-nowrap')>{{ $log->user->name ?? '—' }}</td>
                        <td @class('text-nowrap')>{{ $log->logged_in_at->format('Y-m-d H:i:s') }}</td>
                        <td @class('text-nowrap')>{{ $log->ip_address }}</td>
                        <td @class('text-truncate')>{{ $log->user_agent }}</td>
                        <td>
                            <span
                                @class([
                                    'badge rounded-pill px-3 py-2',
                                    'bg-danger' => $log->blocked,
                                    'bg-success' => ! $log->blocked,
                                ])
                            >
                                {{ $log->blocked ? 'Blocked' : 'Active' }}
                            </span>
                        </td>
                        <td @class('text-nowrap')>
                            @if ($log->blocked)
                                <button
                                    type="button"
                                    wire:click="unblock({{ $log->id }})"
                                    title="Unblock"
                                    @class('btn btn-default border btn-sm text-primary')
                                >
                                    <i @class('bi bi-unlock')></i>
                                </button>
                            @else
                                <button
                                    type="button"
                                    wire:click="block({{ $log->id }})"
                                    title="Block"
                                    @class('btn btn-default border btn-sm text-danger')
                                >
                                    <i @class('bi bi-lock')></i>
                                </button>
                            @endif

                            <button
                                type="button"
                                wire:click="delete({{ $log->id }})"
                                title="Delete"
                                @class('btn btn-default border btn-sm text-muted ms-1')
                            >
                                <i @class('bi bi-trash')></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" @class('text-center text-muted')>No login records found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        <div @class('py-3')>
            {{ $logs->links() }}
        </div>
    </div>
</div>