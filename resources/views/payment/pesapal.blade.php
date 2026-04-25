@extends('payment.layouts.master')

@section('content')
    <div class="d-flex justify-content-center align-items-center" style="min-height: 60vh;">
        <div class="text-center">
            <div class="spinner-border text-primary mb-3" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <h5>Redirecting you to Pesapal to complete your payment...</h5>
            <p class="text-muted">Please do not close or refresh this page.</p>
        </div>
    </div>
@endsection