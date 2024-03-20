<!-- edit.blade.php -->
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
        <h2></h2>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2>Edit User</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('customuser.update', $customuser->id) }}" method="POST" enctype="multipart/form-data">

                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $customuser->name }}">
                            </div>
                            @error('name')
                                <div class="error" style="color: red;">{{ $message }}</div>
                            @enderror
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $customuser->email }}">
                            </div>
                            @error('email')
                                <div class="error" style="color: red;">{{ $message }}</div>
                            @enderror
                            <div class="form-group">
                                <label for="street">Street:</label>
                                <input type="text" class="form-control" id="street" name="address[street]" value="{{ $customuser->addresses->first()->street ?? '' }}">
                            </div>
                             @error('address.street')
                                <div class="error" style="color: red;">{{ $message }}</div>
                            @enderror
                            <div class="form-group">
                                <label for="city">City:</label>
                                <input type="text" class="form-control" id="city" name="address[city]" value="{{ $customuser->addresses->first()->city ?? '' }}">
                            </div>
                            @error('address.city')
                                <div class="error" style="color: red;">{{ $message }}</div>
                            @enderror
                            <div class="form-group">
                                <label for="state">State:</label>
                                <input type="text" class="form-control" id="state" name="address[state]" value="{{ $customuser->addresses->first()->state ?? '' }}">
                            </div>
                            @error('address.state')
                                <div class="error" style="color: red;">{{ $message }}</div>
                            @enderror
                            <div class="form-group">
                                <label for="country">Country:</label>
                                <input type="text" class="form-control" id="country" name="address[country]" value="{{ $customuser->addresses->first()->country ?? '' }}">
                            </div>
                            @error('address.country')
                                <div class="error" style="color: red;">{{ $message }}</div>
                            @enderror
                            <div class="form-group">
                                <label for="photo">Photo:</label>
                                <div class="custom-file">
                                    <input type="file" class="form-control" id="avatar" name="photo" onchange="previewImage(event)" accept="image/*">
                                </div>
                                 <img id="preview" class="mt-4 mb-4 d-block" src="{{ asset('storage/' . $customuser->photo) }}" alt="{{ $customuser->name }}" style="display: none; max-width: 100px; max-height: 100px;">
                            </div>
                            @error('photo')
                                <div class="error" style="color: red;">{{ $message }}</div>
                            @enderror
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImage(event) {
            var preview = document.getElementById('preview');
            preview.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
@endsection
