@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Login') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}" id="formLogin">
                            @csrf

                            <div class="mb-4 row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    <span class="invalid-feedback d-block d-none" role="alert" id="invalid-message-email">
                                        <strong>The email is incorrect!</strong>
                                    </span>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    <span class="invalid-feedback d-block d-none" role="alert"
                                        id="invalid-message-password">
                                        <strong>The password in incorrect!</strong>
                                    </span>
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4 row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
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

        let form = document.querySelector('#formLogin');
        let emailInput = document.getElementById("email");
        let invalidMessageEmail = document.getElementById("invalid-message-email");

        let passwordInput = document.getElementById("password");
        let invalidMessagePassoword = document.getElementById("invalid-message-password");

        //al click: prevent + console 
        form.addEventListener('submit', (event) => {
            event.preventDefault();
            emailInput.classList.remove("is-invalid");
            invalidMessageEmail.classList.add("d-none");

            passwordInput.classList.remove("is-invalid");
            invalidMessagePassoword.classList.add("d-none");

            //prendo valore dell'input            
            let inputEmailValue = emailInput.value;
            let passwordValue = passwordInput.value;

            //if ERRORE - else CORRETTA
            if (!isEmail(inputEmailValue) && passwordValue.length < 8) {
                emailInput.focus();
                emailInput.classList.add("is-invalid");
                invalidMessageEmail.classList.remove("d-none");

                passwordInput.classList.add("is-invalid");
                invalidMessagePassoword.classList.remove("d-none");
            } else if (!isEmail(inputEmailValue)) {
                emailInput.focus();
                emailInput.classList.add("is-invalid");
                invalidMessageEmail.classList.remove("d-none");

            } else if (passwordValue.length < 8) {
                passwordInput.focus();
                passwordInput.classList.add("is-invalid");
                invalidMessagePassoword.classList.remove("d-none");
            } else {
                form.submit();
            }
        });
    </script>
@endsection
