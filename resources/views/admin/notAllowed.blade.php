@extends('layouts.admin')

@section('content')
    <div class="container text-center pt-5">
        <h1 class="mb-3">{{ $message }}. Fatti i cazzi tuoi</h1>
        <a href="{{ route('admin.apartments.index') }}" class="btn btn-outline-secondary">Ritorna ai tuoi appartmaneti</a>
    </div>
@endsection
