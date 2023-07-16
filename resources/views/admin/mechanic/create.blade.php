@extends('layouts.master')

@section('title', 'Add Mechanic')

@section('content')
    <div class="container-fluid px-4">
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="">Add Mechanic</h4>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif
                <form action="{{ url('admin/add-mechanic') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="">Name</label>
                        <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                            name="user_id" required>
                            @foreach ($mechanics as $mechanic)
                                <option class="form-control" name="user_id" value="{{ $mechanic->id }}">
                                    {{ $mechanic->firstname .' '.$mechanic->lastname }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="">Specialization</label>
                        <textarea name="specialization" id="" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="">Status</label>
                        <select class="form-select form-select-sm" aria-label=".form-select-lg example" required="required" name="status">
                        <option value="1">Available</option>
                        <option value="0">Not Available</option>
                        </select>
                    </div>
                    <div class="row">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
