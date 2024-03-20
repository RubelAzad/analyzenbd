<!-- show.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="mb-3">
            <div class="row justify-content-left">
                <div class="col-auto">
                    <a href="{{ route('customuser.index') }}" class="btn btn-success">Back</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header text-center bg-info text-white"> <!-- Change background and text color -->
                        <h2>User Details</h2>
                    </div>
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <p class="text-secondary"><strong>Name:</strong> {{ $customuser->name }}</p> <!-- Change text color -->
                            <p class="text-secondary"><strong>Email:</strong> {{ $customuser->email }}</p> <!-- Change text color -->

                                @foreach ($customuser->addresses as $address)
                                <p class="text-secondary"><strong>Addresses:</strong></p>
                                {{ $address->street }}, {{ $address->city }}, {{ $address->state }}, {{ $address->country }} <br>
                                @endforeach
 <!-- Change text color -->
                            <p class="text-secondary"><strong>Photo:</strong></p>
                            <div class="text-left">
                                <img src="{{ asset('storage/' . $customuser->photo) }}" alt="{{ $customuser->name }}" width="200" class="img-thumbnail mt-4 mb-4">
                            </div>
                            <p class="text-secondary"><strong>Created At:</strong> {{ $customuser->created_at }}</p> <!-- Change text color -->
                            <p class="text-secondary"><strong>Updated At:</strong> {{ $customuser->updated_at }}</p> <!-- Change text color -->
                            <p class="text-secondary"><strong>Deleted At:</strong> {{ $customuser->deleted_at }}</p> <!-- Change text color -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

