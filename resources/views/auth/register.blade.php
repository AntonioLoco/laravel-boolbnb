@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}" id="formRegister">
                            @csrf

                            <div class="mb-4 row">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="lastname"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Lastname') }}</label>

                                <div class="col-md-6">
                                    <input id="lastname" type="text"
                                        class="form-control @error('lastname') is-invalid @enderror" name="lastname"
                                        value="{{ old('lastname') }}" autocomplete="lastname" autofocus>

                                    @error('lastname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="date_of_birth"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Date of Birth') }}</label>

                                <div class="col-md-6">
                                    <input id="date_of_birth" type="date"
                                        class="form-control @error('date_of_birth') is-invalid @enderror"
                                        name="date_of_birth" value="{{ old('date_of_birth') }}" autocomplete="date_of_birth"
                                        autofocus>

                                    @error('date_of_birth')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    <span class="invalid-feedback d-none" role="alert" id="alert-email">
                                        <strong>Email errata, inserisci un email valida</strong>
                                    </span>
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    <span class="invalid-feedback d-none" role="alert" id="alert-password-first">
                                        <strong id="alert-password-text"></strong>
                                    </span>
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" autocomplete="new-password">

                                    <span class="invalid-feedback d-none" role="alert" id="alert-password">
                                        <strong id="alert-password-text"></strong>
                                    </span>
                                </div>
                            </div>

                            <div class="mb-4 row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        //funzione base check email
        function isEmail(email) {
            return /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/.test(email);
        }

        let form = document.querySelector('#formRegister');
        let alertEmail = document.getElementById("alert-email");
        let alertPassword = document.getElementById("alert-password");
        let alertPasswordFirst = document.getElementById("alert-password-first");
        let alertPasswordText = document.getElementById("alert-password-text")

        //al click: prevent + console 
        form.addEventListener('submit', (event) => {
            event.preventDefault();
            document.getElementById("password-confirm").classList.remove("is-invalid");
            document.getElementById("email").classList.remove("is-invalid");


            //prendo valore dell'input            
            let inputEmail = document.getElementById("email").value;
            const password = document.getElementById("password").value;
            const passwordConfirm = document.getElementById("password-confirm").value;


            //if ERRORE - else CORRETTA
            if (!isEmail(inputEmail) && (password !== passwordConfirm)) {
                console.log('email errata e password errata');
                document.getElementById("email").classList.add("is-invalid");
                document.getElementById("password-confirm").classList.add("is-invalid");
                alertEmail.classList.remove("d-none");
                alertPasswordText.innerText = "La password non combacia";
                alertPassword.classList.remove("d-none");
                return
            } else if (!isEmail(inputEmail)) {
                console.log('email errata');
                document.querySelector('#email').focus();
                document.getElementById("email").classList.add("is-invalid");
                alertEmail.classList.remove("d-none");
            } else if (password !== passwordConfirm) {
                document.querySelector('#password-confirm').focus();
                document.getElementById("password-confirm").classList.add("is-invalid");
                alertPasswordText.innerText = "La password non combacia";
                alertPassword.classList.remove("d-none");
            } else if (password.length < 5) {
                document.getElementById("password").classList.add("is-invalid");
                alertPasswordText.innerText = "La password non è valida";
                alertPasswordFirst.classList.remove("d-none");
            } else {
                form.submit();
            }
        });
    </script>
@endsection
