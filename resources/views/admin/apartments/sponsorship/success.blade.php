@extends('layouts.admin')

@section('content')
    <div class="container-fluid d-flex justify-content-center p-5">
        <div class="row row-cols-1 row-cols-md-2 w-75">
            <div class="col text-center">
                <h2>Well done!</h2>
                <h3>Your apartment was updated with the new sponsorship</h3>

                <a href="{{ route('admin.dashboard') }}" class="ms-btn-filter mt-3">
                    Back to dashboard
                </a>
            </div>
            <div class="col text-center">
                <img src="{{ asset('/storage/app/public/payments_images/back-payment-yes.svg') }}" alt="sent-message"
                    class="w-50 pt-5">
            </div>
        </div>
    </div>
@endsection
