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
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $customuser->email }}">
                            </div>
                            <div class="form-group">
                                <label for="photo">Photo:</label>
                                <input type="file" class="form-control" id="avatar" name="photo" onchange="previewImage(event)" accept="image/*">
                                <img id="preview" class="mt-4 mb-4 d-block" src="{{ asset('storage/' . $customuser->photo) }}" alt="{{ $customuser->name }}" width="100">
                            </div>
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
