@extends('layouts.admin')

@section('content')
    <section class="home__section">
        <div class="home__container container-fluid">
            <div class="home__content text-center">
                <p>Hi {{ $user->name }},</p>
                <h1 class="home__title">
                    Welcome to your Dashboard!
                </h1>
                <hr>
                <div class="home__subtitle">
                    @if ($user->apartments->count() >= 1)
                        <p class="mb-5">Total Apartment: {{ $user->apartments->count() }}</p>
                        <p>Here you can see and change all your appartments.</p>
                        <a href="{{ route('admin.apartments.index') }}" class="btn btn-outline-secondary">Show all</a>
                    @else
                        <p class="mt-4">It's easy to get started on Boolbnb</p>
                        <a href="{{ route('admin.apartments.create') }}" class="btn btn-outline-secondary mt-4">Create new
                            apartment</a>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
