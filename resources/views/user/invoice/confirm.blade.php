@extends('user.user')

@section('title', 'Confirm Payment')

@section('content')

    <div class="container-fluid px-4">
        <div class="card mt-4">
            @if (session('message'))
                    <div class="alert alert-success">{{ session('message') }}</div>
            @elseif (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <div class="card-header">
                <h4 class="">Confirm Payment</h4>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif
                <form action="{{ url('query/'.$order->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row text-center">
                        <div class="col-md-3">
                            <label for="">Payment Details</label>
                            <p class="" style="background-color: #f0f0f0;">Total Amount KES <b>{{ $order->paid }}</b></p>
                        </div>
                    </div>
                    <div class="row text-center">
                        <div class="col-md-3 mb-3">
                        <button type="submit" class="btn btn-success">Complete Payement</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
