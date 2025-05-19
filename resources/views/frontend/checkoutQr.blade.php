@extends('frontend.layout.app')

@section('content')
    <div class="container py-4 " style="margin-bottom: 100px;margin-top:30px;">
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white text-center">
                        <h5 class="mb-0">Confirm Your Details</h5>
                    </div>
                    <form method="post" action="{{ route('checkout.store') }}">
                        @csrf
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <img src="{{ asset('frontend/images/myqr.jpg') }}" alt="Product" class="img-fluid"
                                    style="max-width:120px;">
                                <small class="form-text text-muted d-block mb-2">
                                    Please scan this QR and send here
                                </small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Total</label>
                                <input type="text" class="form-control" value="{{ $total }}" id="modal-total"
                                    disabled>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Type Total</label>
                                <input type="number" class="form-control" id="type-total" name="type_total"
                                    autocomplete="off">
                                <small id="total-match-msg" class="form-text text-danger d-none">Amount does not
                                    match!</small>
                            </div>

                            <input type="hidden" class="form-control" value="{{ $name }}" name="name">

                            <input type="hidden" class="form-control" value="{{ $email }}" name="email">

                            <input type="hidden" class="form-control" value="{{ $phone }}" name="phone">


                            <input type="hidden" class="form-control" value="{{ $address }}" name="address">

                        </div>
                        <div class="card-footer bg-white">
                            <button type="submit" class="btn btn-success w-100" id="submit-order-btn" disabled>Submit
                                Order</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var realTotal = parseFloat({{ $total }});
            var typeTotalInput = document.getElementById('type-total');
            var submitBtn = document.getElementById('submit-order-btn');
            var msg = document.getElementById('total-match-msg');
            typeTotalInput.addEventListener('input', function() {
                var typed = parseFloat(this.value);
                if (typed === realTotal) {
                    submitBtn.disabled = false;
                    msg.classList.add('d-none');
                } else {
                    submitBtn.disabled = true;
                    if (this.value !== '') {
                        msg.classList.remove('d-none');
                    } else {
                        msg.classList.add('d-none');
                    }
                }
            });
        });
    </script>
@endpush
