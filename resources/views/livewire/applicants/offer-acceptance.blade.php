{{-- Onboarding --}}
<div>

     {{-- Table Title --}}
    <div @class(['p-5', 'bg-white', 'rounded','border','rounded-bottom-0','border-bottom-0'])>
        <div>
            <h3>Offer Acceptance</h3>
            <p @class(['text-secondary','mb-0'])>
                Overview of all pending, in progress, rejected, approve offers
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
            </tbody>
        </table>

        {{-- Pagination --}}
        <div>
    
        </div>


</div>