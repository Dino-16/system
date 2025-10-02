<div>

    {{-- Table Title --}}
    <div @class('p-5 bg-white rounded border rounded-bottom-0 border-bottom-0')>
            <h3>New Hires Review</h3>
    </div>

    {{-- Table --}}
   <div @class('table-responsive border rounded bg-white px-5 rounded-top-0 border-top-0')>
        <table @class('table')>
            <thead>
                <tr @class('bg-dark')>
                    <th @class('text-secondary fw-normal') scope="col">Full Name</th>
                    <th @class('text-secondary fw-normal') scope="col">Department</th>
                    <th @class('text-secondary fw-normal') scope="col">Job Title</th>
                    <th @class('text-secondary fw-normal') scope="col">New Hire Rating</th>
                    <th @class('text-secondary fw-normal') scope="col">Created At</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="p-3">
        </div>
    </div>

</div>
