@extends('layouts.admin')

@section('content')
    <div class="container-fluid d-flex justify-content-center p-5">
        <div class="row row-cols-1 row-cols-md-2 w-75">
            <div class="col text-center">
                <h2 class="title-payment fw-bolder">Well done!</h2>
                <h3 class="fw-bold">Your apartment was updated with the new sponsorship</h3>

                <a href="{{ route('admin.dashboard') }}" class="btn ms-btn-payment mt-5">
                    Back to dashboard
                </a>
            </div>
            <div class="col text-center">
                <img src="{{ asset('/storage/app/public/payment_images/back-payment-yes.svg') }}" alt="sent-message"
                    class="w-50 pt-5">
            </div>
        </div>
    </div>
@endsection
