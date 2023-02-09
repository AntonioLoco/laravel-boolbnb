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
                                        @if ($sponsor->pivot->is_active)
                                            {{ $sponsor->name }}
                                        @endif
                                    @empty
                                        {{ 'Nessuno' }}
                                    @endforelse
                                </td>
                                <td>{{ $apartment->messages->count() }}</td>
                                <td>
                                    <ul class="d-flex m-0">
                                        <li>
                                            <a href="{{ route('admin.apartments.show', $apartment->slug) }}">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.apartments.edit', $apartment->slug) }}">
                                                <i class="fa-solid fa-dog"></i>
                                            </a>
                                        </li>
                                        <li>
                                            {{-- btn con classe delete-btn 
                                                 data-apartment-title="{{ $apartment->title }}"
                                        --}}
                                            <form action="{{ route('admin.apartments.destroy', $apartment->slug) }}"
                                                method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn delete-btn"
                                                    data-apartment-title="{{ $apartment->title }}">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    {{-- Delete Modal --}}
    @include('partials.delete-modal')
    {{-- / Delete Modal --}}
@endsection
