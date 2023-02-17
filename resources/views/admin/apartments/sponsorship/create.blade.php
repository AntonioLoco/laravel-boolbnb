@extends('layouts.admin')

@section('content')
    <div id="createMessage" class="container p-5 mt-3">
        <div class="mb-5">
            <a href="{{ route('admin.apartments.index') }}" class="btn btn-outline-secondary">
                Back to All
            </a>
        </div>
        <section class="section-title text-center border-bottom border-3">
            <h5 class="fw-ligth">SPONSORSHIP</h5>
            <h1 class="fs-1">Do you want to sponsor the house: {{ $apartment->title }}</h1>
            <p>Select one of the following plans</p>
        </section>

        <div class="row justify-content-center mt-5 text-center">
            <div class="col-7">
                <table class="table table-bordered">
                    <thead>
                        <tr class="tr_bg">
                            <th scope="col"></th>
                            <th scope="col">Type</th>
                            <th scope="col">Price x Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sponsorships as $sponsor)
                            <tr>
                                <td><input type="radio" name="sponsorship_id" value="{{ $sponsor->id }}" id="radio-btn">
                                </td>
                                <td>{{ $sponsor->name }}</td>
                                <td>{{ $sponsor->price }} x {{ $sponsor->hours }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-5 text-end">
                    <a class="btn btn-pay px-5">
                        Pay
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
