@extends('layouts.app')

<style>
    tr,
    td {
        text-align: center;
    }
</style>

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                @if (session('status'))
                    <h6 class="alert alert-success">{{ session('status') }}</h6>
                @endif

                @if (session('status_del'))
                    <h6 class="alert alert-danger">{{ session('status_del') }}</h6>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h4 class="">
                            Show
                            <a href="{{ route('upload') }}" class="btn btn-primary float-end">Add</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered table-stripped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Author</th>
                                    <th>Image</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($uploads as $upload)
                                    <tr>
                                        <td>{{ $upload->id }}</td>
                                        <td>{{ $upload->author }}</td>
                                        <td>
                                            <img src="{{ __('https://res.cloudinary.com/dxeattgd6/image/upload/' . $upload->image) }}"
                                                width="70px" height="70px" alt="Image">
                                        </td>
                                        <td>
                                            <a href="{{ route('upload.edit', $upload->id) }}" class="btn btn-primary">Edit</a>
                                        </td>
                                        <td>
                                            <form action="{{ route('upload.destroy', $upload->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <input type="submit" value="Delete" class="btn btn-danger">
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
