@extends('layouts.admin')

@section('content')
    <div class="apartments-show container my-5">
        @if (session('message'))
            <div class="alert alert-success mb-5">
                {{ session('message') }}
            </div>
        @endif
        <div class="section-title text-center mb-5">
            <h5>SHOW</h5>
            <h1>{{ $apartment->title }}</h1>
            <p>All the details of your item in one place !</p>
        </div>
        <div class="section-description pb-5">
            <div class="row pt-5 border-top border-secondary-subtle">
                <div class="col-12 col-md-6 d-flex align-items-center border-end border-secondary-subtle">
                    <ul>
                        <li class="mb-4">
                            <h5 class="d-inline me-4">TITLE:</h5><span>{{ $apartment->title }}</span>
                        </li>
                        <li class="mb-4">
                            <h5 class="d-inline me-4">TYPE:</h5><span>{{ $apartment->category->name }}</span>
                        </li>
                        <li class="mb-4">
                            <h5 class="d-inline me-4">LOCATION:</h5><span>{{ $apartment->address->street_address }}
                                {{ $apartment->address->house_number }}, {{ $apartment->address->postal_code }}</span>
                        </li>
                    </ul>
                </div>
                <div class="col-12 col-md-6 d-flex">
                    <h5 class="px-3">IMAGE:</h5>
                    <img src="{{ asset('storage/' . $apartment->cover_image) }}" alt="Image {{ $apartment->title }}"
                        class="w-75">
                </div>
                <div class="col-12 mt-5 py-5 d-flex border-top border-bottom border-secondary-subtle">
                    <h5>DESCRIPTION: </h5>
                    <p class="px-4">{{ $apartment->description }}</p>
                </div>
                <div class="col-12 col-md-6 my-5 text-center border-end border-secondary-subtle">
                    <ul>
                        <li class="mb-3">
                            <h5 class="d-inline me-3">SQUARE METERS: </h5>
                            <span>{{ $apartment->square_meters }}</span>
                        </li>
                        <li class="mb-3">
                            <h5 class="d-inline me-3">n° ROOMS: </h5>
                            <span>{{ $apartment->rooms_number }}</span>
                        </li>
                        <li class="mb-3">
                            <h5 class="d-inline me-3">n° BEEDS: </h5>
                            <span>{{ $apartment->beds_number }}</span>
                        </li>
                        <li class="mb-3">
                            <h5 class="d-inline me-3">n° BATHROOMS: </h5>
                            <span>{{ $apartment->bathrooms_number }}</span>
                        </li>
                    </ul>
                </div>
                <div class="col-12 col-md-6 my-5 text-center d-flex justify-content-center">
                    <h5 class="d-inline me-3">SERVICES: </h5>
                    <ul>
                        @foreach ($apartment->services as $service)
                            <li class="mb-3">{{ $service->name }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-12 py-4 d-flex align-items-center border-top border-bottom border-secondary-subtle">
                    <ul class="m-0">
                        <li>
                            <h5 class="d-inline me-3">VISIBLE: </h5>
                            <span>{{ $apartment->visible ? 'YES' : 'NO' }}</span>
                        </li>
                        <li>
                            <h5 class="d-inline me-3">SPONSOR: </h5>
                            @forelse ($apartment->sponsorships as $sponsor)
                                @if ($sponsor->pivot->is_active)
                                    {{ $sponsor->name }}
                                @else
                                    {{ 'Nessuno' }}
                                @endif
                            @empty
                                {{ 'Nessuno' }}
                            @endforelse
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
