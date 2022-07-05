@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-5 mb-5">
                    <div class="card-header">
                        {{ __('Edit') }}
                        <a href="{{ route('view-upload') }}" class="btn btn-primary float-end">View</a>
                    </div>

                    <div class="card-body py-5">
                        @if (session('status'))
                            <h6 class="alert alert-success">{{ session('status') }}</h6>
                        @endif

                        @if (session('status_del'))
                            <h6 class="alert alert-danger">{{ session('status_del') }}</h6>
                        @endif

                        <div class="links">
                            <form action="{{ route('upload.update', $uploads->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="">Author Name</label>
                                    <input type="text" name="author" class="form-control"
                                        value="{{ $uploads->author }}" required>
                                </div>
                                {{-- Display Image --}}
                                <div class="mb-3">
                                    <label for="">Select a File</label>
                                    <input type="file" name="image" class="form-control mb-2">
                                    <img src="{{ __('https://res.cloudinary.com/dxeattgd6/image/upload/' . $uploads->image) }}"
                                        width="70px" height="70px" alt="Image">
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-success">Upload</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
