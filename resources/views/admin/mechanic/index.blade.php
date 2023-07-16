@extends('layouts.master')

@section('title', 'Mechanics List')

@section('content')
    <div class="container-fluid px-4">
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="">Mechanics List
                    <a href="{{ url('admin/add-mechanic') }}" class="btn btn-primary btn-sm float-end">Add Mechanic
                        </a>
                </h4>
            </div>
            <div class="card-body">
                @if (session('message'))
                    <div class="alert alert-success">{{ session('message') }}</div>
                @endif
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Specialization</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mechanics as $mechanic)
                            <tr>
                                <td>{{ $mechanic->id }}</td>
                                <td>{{ App\Models\User::where('id', $mechanic->user_id)->first()->firstname .' '
                                    .App\Models\User::where('id', $mechanic->user_id)->first()->lastname    }}</td>
                                <td>{{ $mechanic->specialization }}</td>
                                @if ($mechanic->status == "1")
                                <td style="color:green">Available</td>
                                @else
                                <td style="color:red">Not Available</td>
                                @endif
                                <td>
                                    <a class="btn btn-primary btn-sm" href="{{ url('admin/edit-mechanic/' . $mechanic->id) }}">Edit</a> |
                                    <a class="btn btn-danger btn-sm" href="{{ url('admin/delete-mechanic/' . $mechanic->id) }}">Delete</a>

                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
