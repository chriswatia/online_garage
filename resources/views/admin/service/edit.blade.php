@extends('layouts.master')

@section('title', 'Edit Service')

@section('content')
    <div class="container-fluid px-4">
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="">Edit Service</h4>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif
                <form action="{{ url('admin/edit-service/'.$service->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="mb-3">
                            <label for="">Service</label>
                            <input type="text" name="service" value="{{ $service->service }}" id="" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="">Description</label>
                        <textarea name="description" id="" class="form-control">{{ $service->description }}</textarea>
                    </div>
                    <div class="row">
                        <div class="mb-3">
                            <label for="">Rate(Kshs)</label>
                            <input type="number" name="rate" value="{{ $service->rate }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
