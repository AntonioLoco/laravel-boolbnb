@extends('layouts.admin')

@section('content')
    <div class="container mt-3">
        <a href="{{ route('admin.apartments.index') }}" class="btn btn-secondary">
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
        <form action="{{ route('admin.apartments.store') }}" method="POST" enctype="multipart/form-data"
            id="create_apartment_form">
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
                <input type="number" class="form-control @error('rooms_number') is-invalid @enderror" id="rooms_number"
                    name="rooms_number" value="{{ old('rooms_number') }}">
                @error('rooms_number')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-2 position-relative">
                <label for="bathrooms_number">Numero di bagni</label>
                <input type="number" class="form-control @error('bathrooms_number') is-invalid @enderror"
                    id="bathrooms_number" name="bathrooms_number" value="{{ old('bathrooms_number') }}">
                @error('bathrooms_number')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-2 position-relative">
                <label for="beds_number">Numero di letti</label>
                <input type="number" class="form-control @error('beds_number') is-invalid @enderror" id="beds_number"
                    name="beds_number" value="{{ old('beds_number') }}">
                @error('beds_number')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-2 position-relative">
                <label for="square_meters">Metri quadrati</label>
                <input type="number" class="form-control @error('square_meters') is-invalid @enderror" id="square_meters"
                    name="square_meters" value="{{ old('square_meters') }}">
                @error('square_meters')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-2">
                <label for="cover_image">Immagine</label>
                <input type="file" class="form-control @error('cover_image') is-invalid @enderror" id='cover_image'
                    name="cover_image" value="{{ old('cover_image') }}">

                {{-- Image Preview --}}
                <div class="mt-3 mb-3 w-50" style="max-width: 400px">
                    <img class="w-50 rounded-4" id="image_preview" src="" alt="">
                </div>

                @error('cover_image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-2">
                <label for="category">Categoria</label>
                <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror">
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


            <div class="mb-2">
                <p>Servizi</p>
                <div class="invalid-feedback d-none" id="error-services">
                    <strong> Aggiungi almeno un servizio </strong>
                </div>
                @foreach ($services as $service)
                    <div class="form-check">
                        <input class="form-check-input check-service @error('services') is-invalid @enderror"
                            type="checkbox" value="{{ $service->id }}" id="service-{{ $service->id }}"
                            name="services[]" @checked(in_array($service->id, old('services', [])))>
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

            <div class="mb-4 pt-5">
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

    <script>
        const createForm = document.getElementById("create_apartment_form");

        createForm.addEventListener("submit", (event) => {
            event.preventDefault();

            const inputTitle = document.getElementById("title");
            const inputAddress = document.getElementById("street_address");
            const inputHouseNumber = document.getElementById("house_number");
            const inputPostalCode = document.getElementById("postal_code");
            const inputRoomsNumber = document.getElementById("rooms_number");
            const inputBathroomsNumber = document.getElementById("bathrooms_number");
            const inputBedsNumber = document.getElementById("beds_number");
            const inputSquareMeters = document.getElementById("square_meters");
            const inputCoverImage = document.getElementById("cover_image");
            const inputCategory = document.getElementById("category_id");
            const servicesCheckboxes = document.getElementsByClassName("check-service");

            inputTitle.classList.remove("is-invalid");
            inputAddress.classList.remove("is-invalid");
            inputHouseNumber.classList.remove("is-invalid");
            inputPostalCode.classList.remove("is-invalid");
            inputRoomsNumber.classList.remove("is-invalid");
            inputBathroomsNumber.classList.remove("is-invalid");
            inputBedsNumber.classList.remove("is-invalid");
            inputSquareMeters.classList.remove("is-invalid");
            inputCoverImage.classList.remove("is-invalid");
            inputCategory.classList.remove("is-invalid");
            document.getElementById("error-services").classList.add("d-none");
            document.getElementById("error-services").classList.remove("d-block");

            let inputValidation = 0;

            if (inputTitle.value.length == 0) {
                inputTitle.classList.add("is-invalid");
                inputValidation++;
            }

            if (inputAddress.value.length == 0) {
                inputAddress.classList.add("is-invalid");
                inputValidation++;
            }

            if (inputHouseNumber.value == "" || typeof(parseInt(inputHouseNumber.value)) != "number" || parseInt(
                    inputHouseNumber.value) <= 0) {
                inputHouseNumber.classList.add("is-invalid");
                inputValidation++;
            }

            if (inputPostalCode.value == "" || typeof(parseInt(inputPostalCode.value)) != "number" || parseInt(
                    inputPostalCode.value) <= 0) {
                inputPostalCode.classList.add("is-invalid");
                inputValidation++;
            }

            if (inputRoomsNumber.value == "" || typeof(parseInt(inputRoomsNumber.value)) != "number" || parseInt(
                    inputRoomsNumber.value) <= 0) {
                inputRoomsNumber.classList.add("is-invalid");
                inputValidation++;
            }

            if (inputBathroomsNumber.value == "" || typeof(parseInt(inputBathroomsNumber.value)) != "number" ||
                parseInt(inputBathroomsNumber.value) <= 0) {
                inputBathroomsNumber.classList.add("is-invalid");
                inputValidation++;
            }

            if (inputBedsNumber.value == "" || typeof(parseInt(inputBedsNumber.value)) != "number" || parseInt(
                    inputBedsNumber.value) <= 0) {
                inputBedsNumber.classList.add("is-invalid");
                inputValidation++;
            }

            if (inputSquareMeters.value == "" || typeof(parseInt(inputSquareMeters.value)) != "number" || parseInt(
                    inputSquareMeters.value) <= 0) {
                inputSquareMeters.classList.add("is-invalid");
                inputValidation++;
            }

            const checkFile = (file) => {
                if (!file) {
                    return true;
                }

                if (!file.type.startsWith("image/")) {
                    return true;
                }

                return false;
            };

            if (checkFile(inputCoverImage.files[0])) {
                inputCoverImage.classList.add("is-invalid");
                inputValidation++;
            }


            if (inputCategory.value == "") {
                inputCategory.classList.add("is-invalid");
                inputValidation++;
            }

            let servicesChecked = 0;
            for (let i = 0; i < servicesCheckboxes.length; i++) {
                const element = servicesCheckboxes[i].checked;
                if (element) {
                    servicesChecked++;
                }
            }

            if (servicesChecked === 0) {
                document.getElementById("error-services").classList.remove("d-none");
                document.getElementById("error-services").classList.add("d-block");
                inputValidation++;
            }


            if (inputValidation === 0) {
                createForm.submit();
            }
        })
    </script>
@endsection
