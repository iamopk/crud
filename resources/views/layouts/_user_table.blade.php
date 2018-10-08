<table class="table table-hover table-responsive">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Last Name</th>
        <th scope="col">Email</th>
        <th scope="col">Gender</th>
        <th scope="col">Suffix</th>
        <th scope="col">Address</th>
        <th scope="col">Role</th>
        <th scope="col">Phone</th>
        <th scope="col">City</th>
        <th scope="col">Company</th>
        <th scope="col">Job</th>
        @can('access-admin-panel')
            <th scope="col"></th>
        @endcan
    </tr>
    </thead>
    <tbody>
    @forelse($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->first_name }}</td>
            <td>{{ $user->second_name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->gender }}</td>
            <td>{{ $user->suffix }}</td>
            <td>{{ $user->address }}</td>
            <td>{{ $roles[$user->role] }}</td>
            <td>{{ $user->phoneNumber }}</td>
            <td>{{ $user->city }}</td>
            <td>{{ $user->company }}</td>
            <td>{{ $user->job }}</td>
            @can('access-admin-panel')
                <td class="d-flex">
                    <a href="{{route('admin.user.edit', ['id' => $user->id] )}}" class="btn btn-primary btn-xs mr-1">Edit</a>
                    <a href="{{route('admin.user.delete', ['id' => $user->id])}}" class="btn btn-danger btn-xs">Delete</a>
                </td>
            @endcan
        </tr>
    @empty
        <tr>
            No Users
        </tr>
    @endforelse
    </tbody>
</table>