@extends('layouts.admin')

@section('content')
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        Pay
    </button>

    <!-- Modal -->
    <div class="modal fade mt-5" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
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
                <div class="modal-body d-flex flex-wrap">

                    <div class="form-group w-75 mb-3 pe-3">
                        <label class="form-label" for=""> Name on card</label>
                        <input class="form-control" type="text" placeholder="Full name" id="" name="">
                    </div>

                    <div class="form-group w-25 mb-3">
                        <label class="form-label" for=""> Expiry</label>
                        <input class="form-control" type="text" placeholder="mm/yyyy" id="" name="">
                    </div>


                    <div class="form-group w-75 mb-3 pe-3">
                        <label class="form-label" for="card-number">Card number</label>
                        <div class="input-group">
                            <input class="form-control" type="text" placeholder="0000-000-0000-000" id="card-number">
                            <span class="input-group-text"> <i class="fa-brands fa-cc-mastercard"></i> </span>
                        </div>
                    </div>


                    <div class="form-group w-25 mb-3">
                        <label class="form-label" for="">CVV</label>
                        <input class="form-control" type="text" placeholder="000" id="" name="">
                    </div>

                </div>
                {{-- /Modal-body --}}

                {{-- Modal-footer --}}
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger">Confirm</button>
                </div>
                {{-- /Modal-footer --}}
            </div>
        </div>
    </div>
@endsection
