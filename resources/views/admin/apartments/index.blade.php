@extends('layouts.admin')

@section('content')
    <div class="container py-5 text-center">
        <h1>Ecco i tuoi appartamenti</h1>

        <div class="row justify-content-center mt-4">
            <div class="col-9">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Visible</th>
                            <th scope="col">Name Apartment</th>
                            <th scope="col">Type</th>
                            <th scope="col">Sponsor</th>
                            <th scope="col">Messages</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($apartments as $apartment)
                            <tr>
                                <th>{{ $apartment->visible ? 'Si' : 'No' }}</th>
                                <td>{{ $apartment->title }}</td>
                                <td>{{ $apartment->category->name }}</td>
                                <td>
                                    @forelse ($apartment->sponsorships as $sponsor)
                                        {{ $sponsor->name }}
                                    @empty
                                        {{ Nessuna }}
                                    @endforelse
                                </td>
                                <td>{{ $apartment->messages->count() }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection