@extends('layouts.admin')

@section('content')
    <div class="container mt-3" id="edit-apartment">
        <div class="text-center text-sm-end">
            <a href="{{ route('admin.apartments.index') }}" class="btn btn-outline-secondary">
                Back to All
            </a>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row mt-5 justify-content-center flex-wrap">
            <div class="col-12 d-flex justify-content-center">
                <div class="col-12 col-lg-8 text-center border-bottom border-2">
                    <h5 class="fs-4 fw-lighter">EDIT</h5>
                    <h2 class="fs-1 fw-bold">Edit your apartment's details</h2>
                    <p class="fs-6 fw-light">Edit your apartment profile in less than 5 minutes.</p>
                </div>
            </div>
            <div class="col-12 d-flex justify-content-center">
                <div class="col-12 col-md-10 col-lg-8">
                    <form action="{{ route('admin.apartments.update', $apartment->slug) }}" method="POST"
                        enctype="multipart/form-data" id="edit_apartment_form">
                        @csrf
                        @method('PUT')
                        <div class=" py-4 border-bottom border-2 d-lg-flex align-items-center justify-content-between">
                            <label for="title">Title</label>
                            <input type="text"
                                class="form-control @error('title') is-invalid @enderror w-75  mt-3 mt-lg-0" id="title"
                                name="title" value="{{ old('title', $apartment->title) }}">
                            @error('title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="py-4 border-bottom border-2 d-lg-flex align-items-center justify-content-between">
                            <label for="description">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror w-75 mt-3 mt-lg-0" name="description"
                                id="description" rows="10">{{ old('description', $apartment->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="py-4 border-bottom border-2">
                            <div class="mb-4 d-lg-flex align-items-center justify-content-between">
                                <label for="street_address">Address</label>
                                <input type="text"
                                    class="form-control @error('street_address') is-invalid @enderror  w-75 mt-3 mt-lg-0"
                                    id="street_address" name="street_address"
                                    value="{{ old('street_address', $apartment->address->street_address) }}">
                                @error('street_address')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div>

                                <div class="d-lg-flex justify-content-lg-between d-sm-block">
                                    <div class="d-lg-flex align-items-center mb-sm-3 mb-lg-0">
                                        <label for="house_number">House Number</label>
                                        <input type="number"
                                            class="form-control @error('house_number') is-invalid @enderror  w-25 mt-3 mt-lg-0 ms-lg-3"
                                            id="house_number" name="house_number"
                                            value="{{ old('house_number', $apartment->address->house_number) }}">
                                        @error('house_number')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="d-lg-flex align-items-center">
                                        <label for="postal_code">Postal Code</label>
                                        <input type="number"
                                            class="form-control @error('postal_code') is-invalid @enderror  w-25 mt-3 mt-lg-0 ms-lg-3"
                                            id="postal_code" name="postal_code"
                                            value="{{ old('postal_code', $apartment->address->postal_code) }}">
                                        @error('postal_code')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="py-4 border-bottom border-2 d-lg-flex justify-content-between flex-wrap">
                            <div class="mb-3 d-lg-flex align-items-center">
                                <label for="rooms_number">Rooms Number</label>
                                <input type="number"
                                    class="form-control @error('rooms_number') is-invalid @enderror w-25 mt-3 mt-lg-0 ms-lg-3"
                                    id="rooms_number" name="rooms_number"
                                    value="{{ old('rooms_number', $apartment->rooms_number) }}">
                                @error('rooms_number')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3 d-lg-flex align-items-center">
                                <label for="bathrooms_number">Bathrooms Number</label>
                                <input type="number"
                                    class="form-control @error('bathrooms_number') is-invalid @enderror w-25 mt-3 mt-lg-0 ms-lg-3"
                                    id="bathrooms_number" name="bathrooms_number"
                                    value="{{ old('bathrooms_number', $apartment->bathrooms_number) }}">
                                @error('bathrooms_number')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3 d-lg-flex align-items-center">
                                <label for="beds_number">Beds Number</label>
                                <input type="number"
                                    class="form-control @error('beds_number') is-invalid @enderror w-25 mt-3 mt-lg-0 ms-lg-3"
                                    id="beds_number" name="beds_number"
                                    value="{{ old('beds_number', $apartment->beds_number) }}">
                                @error('beds_number')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class=" d-lg-flex align-items-center">
                                <label for="square_meters">Square Meters</label>
                                <input type="number"
                                    class="form-control @error('square_meters') is-invalid @enderror w-25 mt-3 mt-lg-0 ms-lg-3"
                                    id="square_meters" name="square_meters"
                                    value="{{ old('square_meters', $apartment->square_meters) }}">
                                @error('square_meters')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="py-4 border-bottom border-2">
                            <label for="cover_image">Cover Image</label>
                            <input type="file" class="form-control @error('cover_image') is-invalid @enderror mt-3"
                                id='cover_image' name="cover_image" value="{{ old('cover_image') }}">

                            {{-- Image Preview --}}
                            <div class="mt-3 mb-3 w-50" style="max-width: 400px">
                                <img class="w-50 rounded-4" id="image_preview"
                                    src="{{ asset('storage/' . $apartment->cover_image) }}"
                                    alt="{{ $apartment->title . 'Cover Image' }}">
                            </div>

                            @error('cover_image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="py-4 border-bottom border-2 d-lg-flex align-items-center justify-content-between">
                            <label for="category">Category</label>
                            <select name="category_id" id="category_id"
                                class="form-select @error('category_id') is-invalid @enderror w-75 mt-3 mt-lg-0">
                                <option value="">Seleziona</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @selected($apartment->category->id == $category->id)>
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


                        <div class="py-4 border-bottom border-2">
                            <p>Services</p>
                            <div class="invalid-feedback d-none" id="error-services">
                                <strong> Add at least one service </strong>
                            </div>
                            <div class="container">
                                <div class="d-md-flex flex-md-wrap">
                                    @foreach ($services as $service)
                                        <div class="form-check me-3 mt-2">
                                            <input
                                                class="form-check-input check-service @error('services') is-invalid @enderror"
                                                type="checkbox" value="{{ $service->id }}"
                                                id="service-{{ $service->id }}" name="services[]"
                                                @checked($errors->any() ? in_array($service->id, old('services', [])) : $apartment->services->contains($service))>
                                            <label class="form-check-label" for="service-{{ $service->id }}">
                                                {{ $service->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @error('services')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4 py-4 border-bottom border-2">
                            <div class="form-check form-switch">
                                <input class="form-check-input @error('visible') is-invalid @enderror" role="switch"
                                    type="checkbox" value="1" id="visible" name="visible"
                                    @checked(old('visible', $apartment->visible))>
                                <label class="form-check-label" for="visible">
                                    Visible
                                </label>
                            </div>
                            @error('visible')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-end mb-5">
                            <button class="ms-auto btn btn-danger" type="submit" class="my-5">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <script>
        const editForm = document.getElementById("edit_apartment_form");

        editForm.addEventListener("submit", function(event) {
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

            if (inputCoverImage.value != "") {
                if (checkFile(inputCoverImage.files[0])) {
                    inputCoverImage.classList.add("is-invalid");
                    inputValidation++;
                }
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
                editForm.submit();
            }
        })
    </script>
@endsection
