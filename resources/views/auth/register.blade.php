@extends('layouts.app')

@section('content')
    <div id="register" class="container-fluid">
        <div class="row">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-text text-center">
                        <img id="icon-img" class="icon" src="{{ asset('storage/icons_svg/login.svg') }}" alt="">
                        <h3 class="mt-3">Welcome to Boolbnb</h3>
                        <p>It's quick and easy.</p>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}" id="formRegister">
                            @csrf

                            <div class="mb-3 row">
                                <div class="col-6 col-xs-2 col-sm-4 col-md-5">
                                    <label for="name" class="col-form-label">{{ __('Name') }}</label>

                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-6 col-sm-4 col-md-5">
                                    <label for="lastname" class="col-form-label text-md-right">{{ __('Lastname') }}</label>
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

                            <div class="mb-3 row">
                                <div class="col-12 col-sm-8 col-md-10">
                                    <label for="date_of_birth"
                                        class="col-form-label text-md-right">{{ __('Date of Birth') }}</label>

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

                            <div class="mb-3 row">
                                <div class="col-12 col-sm-8 col-md-10">
                                    <label for="email"
                                        class="col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    <span class="invalid-feedback d-block d-none" role="alert" id="alert-email">
                                        <strong>The email is incorrect!</strong>
                                    </span>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <div class="col-6 col-xs-2 col-sm-4 col-md-5">
                                    <label for="password"
                                        class="col col-form-label text-md-right">{{ __('Password') }}</label>

                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    <span class="invalid-feedback d-block d-none" role="alert" id="alert-password-first">
                                        <strong id="text-alert-password-first"></strong>
                                    </span>
                                </div>
                                <div class="col-6 col-xs-2 col-sm-4 col-md-5">
                                    <label for="password-confirm"
                                        class="col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" autocomplete="new-password">

                                    <span class="invalid-feedback d-block d-none" role="alert"
                                        id="alert-password-confirm">
                                        <strong id="text-alert-password-confirm"></strong>
                                    </span>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <div class="col-10 col-sm-8 col-md-10">
                                    <span>Already have an account?</span>
                                    <a class="bottom-color ms-2" href="{{ route('login') }}">Login</a>
                                </div>
                            </div>

                            <div class="mb-3 row mb-0">
                                <div class="col-md-10 d-flex justify-content-center">
                                    <button type="submit" class="btn">
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

        //Input
        const form = document.querySelector('#formRegister');
        const passwordFirst = document.getElementById("password");
        const passwordConfirm = document.getElementById("password-confirm");

        //Contenitore errore
        let alertEmail = document.getElementById("alert-email");
        let alertPasswordFirst = document.getElementById("alert-password-first");
        let alertPasswordConfirm = document.getElementById("alert-password-confirm");

        //Messaggio errore password
        let textAlertPasswordFirst = document.getElementById("text-alert-password-first");
        let textAlertPasswordConfirm = document.getElementById("text-alert-password-confirm");


        form.addEventListener('submit', (event) => {
            event.preventDefault();

            //Rimuovo tutti gli errori
            email.classList.remove("is-invalid");
            alertEmail.classList.add("d-none");

            passwordFirst.classList.remove("is-invalid");
            alertPasswordFirst.classList.add("d-none");

            passwordConfirm.classList.remove("is-invalid");
            alertPasswordConfirm.classList.add("d-none");



            //prendo valore dell'input            
            const inputEmail = email.value;
            const password = passwordFirst.value;
            const passwordConfirmValue = passwordConfirm.value;


            //if ERRORE - else CORRETTA
            if (!isEmail(inputEmail) && (password !== passwordConfirmValue)) {
                //Mostro errore email
                email.classList.add("is-invalid");
                alertEmail.classList.remove("d-none");

                //Mostro errore password conferma
                passwordConfirm.classList.add("is-invalid");
                textAlertPasswordConfirm.innerText = "The password does not match";
                alertPasswordConfirm.classList.remove("d-none");
            } else if (!isEmail(inputEmail) && (password.length < 8)) {
                //Mostro errore email
                email.classList.add("is-invalid");
                alertEmail.classList.remove("d-none");
                //Mostro errore password 
                passwordFirst.classList.add("is-invalid");
                textAlertPasswordFirst.innerText = "The password is not valid! Enter at least 8 characters.";
                alertPasswordFirst.classList.remove("d-none");

            } else if (!isEmail(inputEmail)) {
                email.focus();
                email.classList.add("is-invalid");
                alertEmail.classList.remove("d-none");

            } else if (password !== passwordConfirmValue) {
                passwordConfirm.focus();
                passwordConfirm.classList.add("is-invalid");
                textAlertPasswordConfirm.innerText = "The password does not match";
                alertPasswordConfirm.classList.remove("d-none");

            } else if (password.length < 8) {
                passwordFirst.classList.add("is-invalid");
                textAlertPasswordFirst.innerText = "The password is not valid! Enter at least 8 characters.";
                alertPasswordFirst.classList.remove("d-none");
            } else {
                form.submit();
            }
        });
    </script>
@endsection
