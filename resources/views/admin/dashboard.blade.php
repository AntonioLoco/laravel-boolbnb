@extends('layouts.admin')

@section('content')
    <div class="container py-5 text-center">
        <h1>Welcome in your Dashboard!</h1>
        <p class="mt-5">Here you can see and change all your appartments.</p>
        <h4 class="mb-5">TOTAL APARTMENT: {{ $user->apartments->count() }}</h4>
        <a href="{{ route('admin.apartments.index') }}" class="btn btn-outline-secondary">See all your Apartment</a>
    </div>
@endsection
