{{-- Onboarding --}}
<div>

    {{-- Table Title --}}
    <div @class(['p-5', 'bg-white', 'rounded','border','rounded-bottom-0','border-bottom-0'])>
        <div>
            <h3>Offer Acceptance</h3>
            <p @class(['text-secondary','mb-0'])>
                Overview of all On Hold, in progress, rejected, approve offers
            </p>
        </div>
    </div>

    {{-- Table --}}
    <div @class('table-responsive border rounded bg-white px-5 rounded-top-0 border-top-0')>
        <table @class(['table'])>
            <thead>
                <tr @class(['bg-dark'])>
                    <th @class(['text-secondary', 'fw-normal']) scope="col">Candidate</th>
                    <th @class(['text-secondary', 'fw-normal']) scope="col">Email</th>
                    <th @class(['text-secondary', 'fw-normal']) scope="col">Offer</th>
                    <th @class(['text-secondary', 'fw-normal']) scope="col">Status</th>
                    <th @class(['text-secondary', 'fw-normal']) scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($offers as $offer)
                    <tr>
                        <td>{{ $offer->candidate->candidate_first_name }} {{ $offer->candidate->candidate_last_name }}</td>
                        <td>{{ $offer->candidate->candidate_email }}</td>
                        <td>{{ \Carbon\Carbon::parse($offer->offer_date)->format('M d, Y') }}</td>
                        <td>
                            <span @class([
                                'badge rounded-pill px-3 py-2',
                                'bg-warning' => $offer->offer_status === 'Pending',
                                'bg-success' => $offer->offer_status === 'Hired',
                                'bg-secondary' => $offer->offer_status === 'On Hold',
                                'bg-danger' => $offer->offer_status === 'Rejected',
                            ])>
                                {{ $offer->offer_status }}
                            </span>
                        </td>
                        <td>
                            @if ($offer->offer_status === 'Pending')
                                <button wire:click="hire({{ $offer->id }})" class="btn btn-sm btn-success me-1" title="Accept">
                                    <i class="bi bi-check-circle"></i>
                                </button>
                                <button wire:click="hold({{ $offer->id }})" class="btn btn-sm btn-warning me-1" title="Hold">
                                    <i class="bi bi-pause-circle"></i>
                                </button>
                                <button wire:click="reject({{ $offer->id }})" class="btn btn-sm btn-danger" title="Reject">
                                    <i class="bi bi-x-circle"></i>
                                </button>
                            @else
                                <span class="text-muted">No actions</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">No offer records found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="px-3 py-2">
            {{ $offers->links() }}
        </div>
    </div>

</div>