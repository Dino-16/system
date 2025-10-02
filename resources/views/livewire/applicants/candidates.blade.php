<div>

    <div @class(['d-flex', 'justify-content-between', 'align-items-center'])>

        {{-- Search Bar --}}
        <div @class(['mb-3', 'w-25'])>
            <x-text-input type="search" wire:model.live.debounce.3s="search" placeholder="Search..." />
        </div>

    </div>
    
    {{-- Table Title --}}
    <div @class(['p-5', 'bg-white', 'rounded','border','rounded-bottom-0','border-bottom-0'])>
        <div>
            <h3>All Candidates</h3>
            <p @class('text-secondary mb-0')>Overview of all qualified candidate</p>
        </div>
    </div>


    {{-- Table --}}
    <div @class(['table-responsive', 'card', 'px-5', 'rounded-top-0', 'border-top-0'])>
        <table @class(['table'])>
            <thead>
                <tr @class(['bg-dark'])>
                    <th @class(['text-secondary', 'fw-normal']) scope="col">Candidate Name</th>
                    <th @class(['text-secondary', 'fw-normal']) scope="col">Applied Job</th>
                    <th @class(['text-secondary', 'fw-normal']) scope="col">Email</th>
                    <th @class(['text-secondary', 'fw-normal']) scope="col">Date Qualified</th>
                    <th @class(['text-secondary', 'fw-normal']) scope="col">Status</th>
                    <th @class(['text-secondary', 'fw-normal']) scope="col">Interview Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($candidates as $candidate)
                    <tr>
                        <td @class(['text-nowrap'])>
                            {{ ucwords($candidate->candidate_first_name . '  ' . $candidate->candidate_last_name) }}
                        </td>

                        <td @class(['text-truncate'])>
                            {{ $candidate->candidate_job_title ?? 'N/A' }}
                        </td>

                        <td @class(['text-truncate'])>
                            {{ $candidate->candidate_email }}
                        </td>

                        <td @class(['text-nowrap'])>
                            {{ $candidate->created_at->format('Y-m-d') }}
                        </td>

                        <td 
                            @class([
                                'text-nowrap',
                                'text-success' => in_array($candidate->status, ['Scheduled', 'Passed']),
                                'text-info' => in_array($candidate->status, ['Initial', 'Final']),
                                'text-danger' => $candidate->status === 'Rejected',
                            ])
                        >
                            @if(in_array($candidate->status, ['Initial', 'Final']))
                                Interviewing
                            @else
                                {{ $candidate->status ?? 'Qualified' }}
                            @endif
                        </td>

                        {{-- Interview Date/Time Column --}}
                        <td @class(['text-nowrap'])>
                            @if($candidate->status === 'Passed')
                                <span @class(['text-success'])>Passed</span>
                            @elseif($candidate->status === 'Rejected')
                                <span @class(['text-danger'])>Rejected</span>
                            @else
                                @if ($candidate->interviewDate)
                                    {{ $candidate->interviewDate }} {{ $candidate->interviewTime }}
                                @else
                                    <span>To be scheduled</span>
                                @endif
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" @class(['text-center', 'text-muted'])>No candidates found.</td>
                    </tr>
                @endforelse
            </tbody>

        </table>

        {{-- Pagination --}}
        <div>

        </div>

    </div>

</div>