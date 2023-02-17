@extends('layouts.admin')

@section('content')
    <div class="container-fluid d-flex justify-content-center p-5">
        <div class="row row-cols-1 row-cols-md-2 w-75">
            <div class="col text-center">
                <h2 class="title-payment fw-bolder">Error</h2>
                <h3 class="fw-bold">Sorry, the card was invalid ...</h3>

                <a href="{{ route('admin.apartment.sponsorship', $apartment->slug) }}" class="btn ms-btn-payment mt-5 me-3">
                    Back to sponsorship
                </a>
                <a href="{{ route('admin.dashboard') }}" class="btn ms-btn-payment-failed mt-5">
                    Contact us
                </a>
            </div>
            <div class="col text-center">
                <img src="{{ asset('/storage/payment_images/back-payment-no.svg') }}" alt="sent-message" class="w-50 pt-5">
            </div>
        </div>
    </div>
@endsection
