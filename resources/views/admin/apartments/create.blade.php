@extends('layouts.admin')

@section('content')
    <div class="container mt-3">
        <a href="{{ route('admin.apartments.index') }}" class="btn btn-secondary" type="button>
            <i class="fa-solid
            fa-arrow-left"></i>
            Torna ad appartamenti
        </a>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('admin.apartments.store') }}" method="POST" enctype="multipart/form-data" id="create_form">
            @csrf
            <div class="mb-2 position-relative">
                <label for="title">Titolo appartamento</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                    name="title" value="{{ old('title') }}">
                @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-2">
                <label for="description">Descrizione</label>
                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                    rows="10">{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-2 position-relative">
                <label for="street_address">Indirizzo</label>
                <input type="text" class="form-control @error('street_address') is-invalid @enderror" id="street_address"
                    name="street_address" value="{{ old('street_address') }}">
                @error('street_address')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-2 position-relative">
                <label for="house_number">Numero Civico</label>
                <input type="number" class="form-control @error('house_number') is-invalid @enderror" id="house_number"
                    name="house_number" value="{{ old('house_number') }}">
                @error('house_number')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-2 position-relative">
                <label for="postal_code">Codice Postale</label>
                <input type="number" class="form-control @error('postal_code') is-invalid @enderror" id="postal_code"
                    name="postal_code" value="{{ old('postal_code') }}">
                @error('postal_code')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>


            <div class="mb-2 position-relative">
                <label for="rooms_number">Numero di camere</label>
                <input type="number" class="form-control @error('rooms_number') is-invalid @enderror" id="title"
                    name="rooms_number" value="{{ old('rooms_number') }}">
                @error('rooms_number')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-2 position-relative">
                <label for="bathrooms_number">Numero di bagni</label>
                <input type="number" class="form-control @error('bathrooms_number') is-invalid @enderror" id="title"
                    name="bathrooms_number" value="{{ old('bathrooms_number') }}">
                @error('bathrooms_number')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-2 position-relative">
                <label for="beds_number">Numero di letti</label>
                <input type="number" class="form-control @error('beds_number') is-invalid @enderror" id="title"
                    name="beds_number" value="{{ old('beds_number') }}">
                @error('beds_number')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-2 position-relative">
                <label for="square_meters">Metri quadrati</label>
                <input type="number" class="form-control @error('square_meters') is-invalid @enderror" id="title"
                    name="square_meters" value="{{ old('square_meters') }}">
                @error('square_meters')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div>
                <label for="cover_image">Immagine</label>
                <input type="file" class="form-control @error('cover_image') is-invalid @enderror" id='cover_image'
                    name="cover_image" value="{{ old('cover_image') }}">
                @error('cover_image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-2">
                <label for="category">Categoria</label>
                <div>
                    <select name="category_id" id="category_id"
                        class="form-select @error('category_id') is-invalid @enderror">
                        <option value="">Seleziona</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                                {{ Str::ucfirst($category->name) }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>


            <div class="mb-2">
                <p>Servizi</p>
                @foreach ($services as $service)
                    <div class="form-check">
                        <input class="form-check-input @error('services') is-invalid @enderror" type="checkbox"
                            value="{{ $service->id }}" id="service-{{ $service->id }}" name="services[]"
                            @checked(in_array($service->id, old('services', [])))>
                        <label class="form-check-label" for="service-{{ $service->id }}">
                            {{ $service->name }}
                        </label>
                    </div>
                @endforeach
                @error('services')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-2">
                <p>Visibile</p>
                <div class="form-check">
                    <input class="form-check-input @error('visible') is-invalid @enderror" type="checkbox"
                        value="1" id="visible" name="visible" @checked(old('visible'))>
                    <label class="form-check-label" for="visible">
                        Visibile
                    </label>
                </div>
                @error('visible')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button class="btn btn-dark" type="submit">Aggiungi</button>
        </form>
    </div>
@endsection
