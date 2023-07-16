@extends('layouts.master')

@section('title', 'Edit Mechanic')

@section('content')
    <div class="container-fluid px-4">
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="">Edit Mechanic</h4>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif
                <form action="{{ url('admin/edit-mechanic/'.$mechanic->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="">Name</label>
                        <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="user_id" disabled>
                            @foreach ($mechanics as $user)
                            <option {{ old('user_id', $mechanic->user_id) ==  $user->id ? 'selected' : ''}} value="{{ $user->id }}">{{ $user->firstname .' '.$user->lastname }}</option>

                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="">Specialization</label>
                        <textarea name="specialization" id="" class="form-control">{{ $mechanic->specialization }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="">Status</label>
                        <select class="form-select form-select-sm" aria-label=".form-select-lg example" required="required" name="status">
                        <option value="1" @if (old($mechanic->status) == "1") {{ "selected" }} @endif>Available</option>
                        <option value="0" @if (old($mechanic->status) == "0") {{ "selected" }} @endif>Not Available</option>
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
