<div>

    {{-- Table Title --}}
    <div @class('p-5 bg-white rounded border rounded-bottom-0 border-bottom-0')>
            <h3>Employee Evaluations</h3>
    </div>

    {{-- Table --}}
   <div @class('table-responsive border rounded bg-white px-5 rounded-top-0 border-top-0')>
        <table @class('table')>
            <thead>
                <tr @class('bg-dark')>
                    <th @class('text-secondary fw-normal') scope="col">Full Name</th>
                    <th @class('text-secondary fw-normal') scope="col">Department</th>
                    <th @class('text-secondary fw-normal') scope="col">Job Title</th>
                    <th @class('text-secondary fw-normal') scope="col">Review Period</th>
                    <th @class('text-secondary fw-normal') scope="col">Reviewer</th>
                    <th @class('text-secondary fw-normal') scope="col">Employee Rating</th>
                    <th @class('text-secondary fw-normal') scope="col">Confidence</th>
                    <th @class('text-secondary fw-normal') scope="col">Strengths</th>
                    <th @class('text-secondary fw-normal') scope="col">Improvements</th>
                    <th @class('text-secondary fw-normal') scope="col">Created At</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($evaluations as $evaluation)
                    <tr>
                        <td class="text-nowrap">{{ $evaluation->full_name }}</td>
                        <td>{{ $evaluation->department }}</td>
                        <td>{{ $evaluation->job_title }}</td>
                        <td>{{ $evaluation->review_period }}</td>
                        <td>{{ $evaluation->reviewer_name }}</td>
                        <td>{{ $evaluation->employee_rating }}</td>
                        <td>{{ $evaluation->confidence_level }}</td>
                        <td class="text-truncate" style="max-width: 200px;">
                            {{ $evaluation->strengths }}
                        </td>
                        <td class="text-truncate" style="max-width: 200px;">
                            {{ $evaluation->improvements }}
                        </td>
                        <td>{{ $evaluation->created_at->format('Y-m-d') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center text-muted">
                            No evaluations found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="p-3">
            {{ $evaluations->links() }}
        </div>
    </div>

</div>
