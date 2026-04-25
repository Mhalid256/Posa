@extends('payment.layouts.master')

@section('content')
    <div class="d-flex justify-content-center align-items-center" style="min-height: 60vh;">
        <div class="text-center">
            <div class="mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="#dc3545" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
                </svg>
            </div>
            <h4 class="text-danger">Payment Error</h4>
            <p class="text-muted">{{ $message ?? 'Something went wrong with your Pesapal payment.' }}</p>
            <a href="{{ url()->previous() }}" class="btn btn-primary mt-2">Go Back</a>
        </div>
    </div>
@endsection