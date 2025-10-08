<div class="container mt-4">
    <h3>Employee List</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Position</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $employee)
                <tr>
                    <td>{{ $employee['name'] }}</td>
                    <td>{{ $employee['email'] }}</td>
                    <td>{{ $employee['role'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
