<!-- users.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="mb-3">
            <div class="row justify-content-between align-items-center">
                <div class="col-auto">
                    <h2 class="mb-0">User List</h2>
                </div>
                <div class="col-auto">
                    <a href="{{ route('customuser.create') }}" class="btn btn-success">Create User</a>
                    <a href="{{ route('deleted') }}" class="btn btn-success ml-2">Show Deleted User</a>
                </div>
            </div>
        </div>

        <div class="table-responsive"> <!-- Make table responsive -->
            <table class="table table-bordered">
                <thead class="thead-dark"> <!-- Dark header -->
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Photo</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                            @foreach ($user->addresses as $address)
                                {{ $address->street }}, {{ $address->state }}, {{ $address->city }}, {{ $address->country }}<br>
                            @endforeach
                            </td>
                            <td><img src="{{ asset('storage/' . $user->photo) }}" alt="{{ $user->name }}" width="60"></td>
                            <td>
                                <a href="{{ route('customuser.show', $user->id) }}" class="btn btn-primary">View</a>
                                <a href="{{ route('customuser.edit', $user->id) }}" class="btn btn-secondary">Edit</a>
                                <form action="{{ route('customuser.destroy', $user->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
