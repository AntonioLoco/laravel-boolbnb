@extends('layouts.admin')

@section('content')
    <div id="createMessage" class="container p-5 mt-3">
        <div class="mb-5">
            <a href="{{ route('admin.apartments.index') }}" class="btn btn-outline-secondary">
                Back to All
            </a>
        </div>
        <section class="section-title text-center border-bottom border-3">
            <h5 class="fw-ligth">SPONSORSHIP</h5>
            <h1 class="fs-1">Do you want to sponsor the house: {{ $apartment->title }}</h1>
            <p>Select one of the following plans</p>
        </section>

        <div class="row justify-content-center mt-5 text-center">
            <div class="col-7">
                <table class="table table-bordered">
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
                    <button type="button" class="btn btn-pay px-5" data-bs-toggle="modal" data-bs-target="#myModal"
                        id="btn-pay">
                        Pay
                    </button>
                </div>
            </div>
        </div>


        {{-- Modal Payment --}}


        <!-- Modal -->
        <div class="modal fade mt-5" id="myModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
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
                    <form action="{{ route('admin.apartment.checkout') }}" method="POST" id="payment-form">
                        @csrf
                        <div class="modal-body d-flex flex-wrap">
                            <div class="form-group w-75 mb-3 pe-3">
                                <label class="form-label" for="name"> Name on card</label>
                                <input class="form-control" type="text" placeholder="Full name" id="name"
                                    name="name_of_card">
                            </div>

                            <div class="form-group w-25 mb-3">
                                <label class="form-label" for="expiry"> Expiry</label>

                                <div class="form-group" id="expiration-date">

                                </div>
                            </div>


                            <div class="form-group w-75 mb-3 pe-3">
                                <label class="form-label" for="card-number">Card number</label>
                                <div class="form-group" id="card-number">

                                </div>
                            </div>


                            <div class="form-group w-25 mb-3">
                                <label class="form-label" for="">CVV</label>
                                <div class="form-group" id="cvv">

                                </div>
                            </div>

                            <input id="sponsorship_id" name="sponsorship_id" type="hidden" />
                            <input id="apartment_id" name="apartment_id" type="hidden">
                            <input id="nonce" name="payment_method_nonce" type="hidden" />
                        </div>
                        {{-- /Modal-body --}}

                        {{-- Modal-footer --}}
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="reset" class="btn btn-outline-dark" data-bs-dismiss="modal">Cancel</button>

                            <button type="submit" class="btn btn-danger">Confirm Payment</button>
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
        var submit = document.querySelector('input[type="submit"]');
        var myModal = document.getElementById('myModal');
        const btn = document.querySelector("#btn-pay");
        const radioButtons = document.getElementsByName('sponsorships_value');



        // btn.addEventListener("click", function() {
        //     document.querySelector(".modal-backdrop").classList.remove("d-none");
        //     myModal.classList.remove("d-none");
        //     let isChecked = false;
        //     for (let i = 0; i < radioButtons.length; i++) {
        //         if (radioButtons[i].checked) {
        //             isChecked = true;
        //             break;
        //         }
        //     }
        //     if (isChecked === false) {
        //         myModal.classList.add("d-none");
        //         document.querySelector(".modal-backdrop").classList.add("d-none");
        //     }
        // });

        // myModal.show();


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
                        'color': 'green'
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
                }
            }, function(hostedFieldsErr, hostedFieldsInstance) {
                if (hostedFieldsErr) {
                    console.error(hostedFieldsErr);
                    return;
                }
                // submit.removeAttribute('disabled');
                form.addEventListener('submit', function(event) {
                    event.preventDefault();
                    hostedFieldsInstance.tokenize(function(tokenizeErr, payload) {
                        if (tokenizeErr) {
                            console.error(tokenizeErr);
                            return;
                        }
                        // If this was a real integration, this is where you would
                        // send the nonce to your server.
                        // console.log('Got a nonce: ' + payload.nonce);

                        document.querySelector("#sponsorship_id").value = document
                            .querySelector("input[name='sponsorships_value']:checked").value
                        document.querySelector("#apartment_id").value =
                            "{{ $apartment->id }}";
                        console.log("qui arrivo");
                        document.querySelector('#nonce').value = payload.nonce;
                        form.submit();
                    });
                }, false);
            });
        });
    </script>
@endsection
