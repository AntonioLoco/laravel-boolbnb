@extends('layouts.admin')

@section('content')
    <div id="createMessage" class="container">
        <div class="btn-back mt-3">
            <a href="{{ route('admin.apartments.index') }}" class="btn btn-outline-secondary">Back</a>
        </div>
        <section class="sponsor__title text-center">
            <p>SPONSORSHIP</p>
            <h1>Do you want to sponsor: {{ $apartment->title }}?</h1>
            <p class="mt-4">Select one of the following plans:</p>
        </section>

        <div class="row justify-content-center text-center">
            <div class="col-7">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="m-0">
                            @foreach ($errors->all() as $error)
                                <li>
                                    {{ $error }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <table class="table table-bordered mt-3">
                    <thead>
                        <tr class="tr_bg">
                            <th scope="col"></th>
                            <th scope="col">Type</th>
                            <th scope="col">Price x Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sponsorships as $sponsor)
                            <tr>
                                <td><input type="radio" value="{{ $sponsor->id }}" id="radio-btn"
                                        name="sponsorships_value">
                                </td>
                                <td>{{ $sponsor->name }}</td>
                                <td>{{ $sponsor->price }} x {{ $sponsor->hours }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-5 text-end">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-pay px-5 disabled" id="btn-pay">
                        Pay
                    </button>
                    {{-- data-bs-toggle="modal" data-bs-target="#myModal" --}}
                </div>
            </div>
        </div>


        {{-- Modal Payment --}}


        <!-- Modal -->
        <div class="modal fade mt-5" id="payment-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    {{-- Modal-header --}}
                    <div class="modal-header d-flex flex-column">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                        <div class="text-center">
                            <i class="fa-regular fa-credit-card fa-xl"></i>
                            <h1 class="modal-title fs-5 mt-3 id="staticBackdropLabel">Update payment method</h1>
                            <span class="fst-italic"> Insert your card details </span>
                        </div>
                    </div>
                    {{-- / Modal-header --}}

                    {{-- Modal-body --}}
                    <form action="{{ route('admin.apartment.checkout') }}" method="POST" id="payment-form"
                        autocomplete="off">
                        @csrf
                        <div class="modal-body">
                            <div class=" mb-3">
                                <label for="cc_number">Card number</label>
                                <div class="form-group position-relative" id="card-number">

                                    <span class="input-group-text position-absolute top-0 bottom-0 end-0"> <i
                                            class="fa-brands fa-cc-mastercard"></i> </span>
                                </div>
                            </div>

                            <div class="row justify-content-between">
                                <div class="col-7">
                                    <label for="expiry"> Expiry</label>

                                    <div class="form-group position-relative" id="expiration-date">

                                        <span class="input-group-text position-absolute top-0 bottom-0 end-0">
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <label for="cvv">CVV</label>
                                    <div class="form-group position-relative" id="cvv">

                                        <span class="input-group-text position-absolute top-0 bottom-0 end-0">
                                            <i class="fa-solid fa-lock"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <input id="sponsorship_id" name="sponsorship_id" type="hidden" />
                            <input id="apartment_id" name="apartment_id" type="hidden" />
                            <input id="nonce" name="payment_method_nonce" type="hidden" />
                        </div>
                        {{-- /Modal-body --}}

                        {{-- Modal-footer --}}
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="reset" class="btn btn-outline-dark" data-bs-dismiss="modal">Cancel</button>

                            <button type="submit" class="btn btn-danger" id="confirm-payment">Confirm Payment</button>

                            {{-- Loader Btn --}}
                            <div class="spinner-border text-danger ms-3" role="status" id="confirm-payment-loading">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                        {{-- /Modal-footer --}}
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="https://js.braintreegateway.com/web/3.38.1/js/client.min.js"></script>
    <script src="https://js.braintreegateway.com/web/3.38.1/js/hosted-fields.min.js"></script>
    <script>
        var form = document.querySelector('#payment-form');

        const cardNumber = document.querySelector("#card-number");
        const expiryNumber = document.querySelector("#expiration-date");
        const cvvNumber = document.querySelector("#cvv");
        //BTN Confirm payment + loading
        const confirmBtn = document.getElementById('confirm-payment');
        const confirmBtnLoading = document.getElementById('confirm-payment-loading');
        confirmBtnLoading.classList.add('d-none');

        braintree.client.create({
            authorization: '{{ $token }}'
        }, function(clientErr, clientInstance) {
            if (clientErr) {
                console.error(clientErr);
                return;
            }
            // This example shows Hosted Fields, but you can also use this
            // client instance to create additional components here, such as
            // PayPal or Data Collector.
            braintree.hostedFields.create({
                client: clientInstance,
                styles: {
                    'input': {
                        'font-size': '14px'
                    },
                    'input.invalid': {
                        'color': 'red'
                    },
                    'input.valid': {
                        'color': 'green',
                    }
                },
                fields: {
                    number: {
                        selector: '#card-number',
                        placeholder: '4111 1111 1111 1111'
                    },
                    cvv: {
                        selector: '#cvv',
                        placeholder: '123'
                    },
                    expirationDate: {
                        selector: '#expiration-date',
                        placeholder: '10/2019'
                    }
                },
            }, function(hostedFieldsErr, hostedFieldsInstance) {
                if (hostedFieldsErr) {
                    console.log(hostedFieldsErr);
                    return;
                }
                // submit.removeAttribute('disabled');
                form.addEventListener('submit', function(event) {
                    event.preventDefault();
                    cardNumber.classList.remove("braintree-hosted-fields-invalid");
                    expiryNumber.classList.remove(
                        "braintree-hosted-fields-invalid");
                    cvvNumber.classList.remove("braintree-hosted-fields-invalid");

                    hostedFieldsInstance.tokenize(function(tokenizeErr, payload) {
                        if (tokenizeErr) {
                            console.error(tokenizeErr);
                            if (!tokenizeErr.details) {
                                cardNumber.classList.add("braintree-hosted-fields-invalid");
                                expiryNumber.classList.add(
                                    "braintree-hosted-fields-invalid");
                                cvvNumber.classList.add("braintree-hosted-fields-invalid");
                            }

                            if (tokenizeErr.details) {
                                const invalidFields = tokenizeErr.details
                                    .invalidFields;

                                if (invalidFields.cvv) {
                                    invalidFields.cvv.classList.add(
                                        "braintree-hosted-fields-invalid")
                                }

                                if (invalidFields.expirationDate) {
                                    invalidFields.expirationDate.classList.add(
                                        "braintree-hosted-fields-invalid")
                                }

                                if (invalidFields.number) {
                                    invalidFields.number.classList.add(
                                        "braintree-hosted-fields-invalid")
                                }
                            }


                            return;
                        }

                        document.querySelector("#sponsorship_id").value = document
                            .querySelector("input[name='sponsorships_value']:checked").value
                        document.querySelector("#apartment_id").value =
                            "{{ $apartment->id }}";
                        document.querySelector('#nonce').value = payload.nonce;
                        form.submit();

                        //BTN Confirm payment + loading
                        confirmBtnLoading.classList.remove('d-none');
                        confirmBtn.classList.add('d-none');
                    });
                }, false);
            });
        });
    </script>
@endsection
