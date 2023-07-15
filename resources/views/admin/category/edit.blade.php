@extends('layouts.master')

@section('title', 'Edit Service Category')

@section('content')
    <div class="container-fluid px-4">
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="">Edit Service Category</h4>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif
                <form action="{{ url('admin/edit-category/'.$category->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="">Name</label>
                        <input type="text" name="name" value="{{ $category->name }}" id="" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="">Description</label>
                        <textarea name="description" id="" class="form-control">{{ $category->description }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="">Status</label>
                        <select class="form-select form-select-sm" aria-label=".form-select-lg example" required="required" name="status">                                    
                        <option value="1" @if (old($category->status) == "1") {{ "selected" }} @endif>Available</option>
                        <option value="0" @if (old($category->status) == "0") {{ "selected" }} @endif>Not Available</option>
                        </select>
                    </div>
                    <div class="row">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
