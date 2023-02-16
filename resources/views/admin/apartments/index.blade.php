@extends('layouts.admin')

@section('content')
    <section id="index" class="container text-center p-2">
        @if (session('message'))
            <div class="alert alert-success my-3">
                {{ session('message') }}
            </div>
        @endif

        <div class="index__title">
            <p>Here you can view all</p>
            <h1>Your Apartments</h1>
        </div>

        <table class="table table-bordered table-md">
            <thead>
                <tr>
                    <th scope="col">Visible</th>
                    <th scope="col">Apartment</th>
                    <th scope="col">Type</th>
                    <th scope="col">Sponsor</th>
                    <th scope="col">Messages</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($apartments as $apartment)
                    <tr>
                        <td>
                            <input type="hidden" name="visible" value="{{ $apartment->visible }}">
                            <input type="checkbox" name="visible_dummy" {{ $apartment->visible ? 'checked' : '' }} disabled>

                        </td>
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
                        <td>
                            <a href="{{ route('admin.apartment.message', $apartment->slug) }}" class="btn btn-outline">
                                <i class="fa-solid fa-eye"></i>
                                {{ $apartment->messages->count() }}
                            </a>
                        </td>
                        <td>
                            <ul class="d-flex align-items-center justify-content-center p-0 m-0">
                                <li>
                                    <a href="{{ route('admin.apartments.show', $apartment->slug) }}" class="btn">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.apartments.edit', $apartment->slug) }}" class="btn">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                </li>
                                <li>
                                    <form action="{{ route('admin.apartments.destroy', $apartment->slug) }}"
                                        method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn delete-btn" data-apartment-title="{{ $apartment->title }}">
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

        <table class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th scope="col">Apartment</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($apartments as $apartment)
                    <tr>
                        <td>{{ $apartment->title }}</td>
                        <td>
                            <ul class="d-flex align-items-center justify-content-center p-0 m-0">
                                <li>
                                    <a href="{{ route('admin.apartments.show', $apartment->slug) }}" class="btn">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.apartments.edit', $apartment->slug) }}" class="btn">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                </li>
                                <li>
                                    <form action="{{ route('admin.apartments.destroy', $apartment->slug) }}"
                                        method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn delete-btn" data-apartment-title="{{ $apartment->title }}">
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
    </section>
    {{-- Delete Modal --}}
    @include('partials.delete-modal')
    {{-- / Delete Modal --}}
@endsection
