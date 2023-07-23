@extends('layouts.master')

@section('title', 'Service List')

@section('content')
    <div class="container-fluid px-4">
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="">Service List
                    <a href="{{ url('admin/add-service') }}" class="btn btn-primary btn-sm float-end">Add Service
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
                            <th>Service</th>
                            <th>Description</th>
                            <th>Rate(Kshs)</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($services as $service)
                            <tr>
                                <td>{{ $service->id }}</td>
                                <td>{{ $service->service }}</td>
                                <td>{{ $service->description }}</td>
                                <td>{{ $service->rate }}</td>
                                <td>
                                    <a class="btn btn-primary btn-sm" href="{{ url('admin/edit-service/' . $service->id) }}">Edit</a> |
                                    <a class="btn btn-danger btn-sm" href="{{ url('admin/delete-service/' . $service->id) }}">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
