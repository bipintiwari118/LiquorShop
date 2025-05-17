@extends('frontend.layout.app')

@section('styles')
    <style>
        .checkout-section {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.07);
            padding: 2rem 1.5rem;
            margin-bottom: 2rem;
        }

        .order-summary-table {
            background: #f8f9fa;
            border-radius: 12px;
            /* Increased horizontal padding */
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
            min-width: 420px;
            /* Add this line for minimum width */
            width: 100%;
            max-width: 100%;
        }

        .order-summary-table .total-col {
            min-width: 110px;
            width: 130px;
            /* You can adjust these values as needed */
        }

        .order-summary-table .table th,
        .order-summary-table .table td {
            vertical-align: middle;
            font-size: 1rem;
        }

        .order-summary-table thead th {
            background: #e3eafc;
            color: #1a237e;
            border-bottom: 2px solid #dee2e6;
        }

        .order-summary-table tfoot th {
            background: #f4f6fb;
            font-weight: 600;
        }

        .payment-methods .form-check-label {
            font-weight: 500;
            font-size: 1rem;
            cursor: pointer;
        }

        .payment-methods .form-check-input {
            margin-top: 0.2rem;
            margin-right: 0.5rem;
        }

        @media (max-width: 991.98px) {
            .order-summary-table {
                margin-top: 2rem;
            }
        }

        @media (max-width: 767.98px) {
            .checkout-section {
                padding: 1rem 0.5rem;
            }

            .order-summary-table {
                padding: 1rem 0.3rem;
            }

            .order-summary-table .table th,
            .order-summary-table .table td {
                font-size: 0.95rem;
                padding: 0.4rem;
            }
        }

        @media (max-width: 575.98px) {

            .order-summary-table .table th,
            .order-summary-table .table td {
                font-size: 0.85rem;
                padding: 0.25rem;
            }
        }
    </style>
@endsection

@section('content')
    <div class="container py-4">
        <form method="post" action="{{ route('checkout.store') }}">
            @csrf
            <div class="row">
                <!-- Customer Details -->
                <div class="col-lg-7">
                    <div class="checkout-section mb-4">
                        <h3 class="mb-4 font-weight-bold text-primary">Customer Details</h3>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Full Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control"  placeholder="Your Name">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control" 
                                    placeholder="you@email.com">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Phone <span class="text-danger">*</span></label>
                                <input type="text" name="phone" class="form-control" 
                                    placeholder="Phone Number">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">City <span class="text-danger">*</span></label>
                                <input type="text" name="city" class="form-control"  placeholder="City">
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Address <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="address" rows="2"  placeholder="Full Address"></textarea>
                            </div>
                            <input type="hidden" value="{{ $total }}">
                        </div>

                    </div>
                </div>
                <!-- Right Side: Order Summary, Payment, Button -->
                <div class="col-lg-5">
                    <div class="checkout-section mb-4">
                        <!-- Order Summary (above) -->
                        <div class="order-summary-table mb-4">
                            <h5 class="mb-3 font-weight-bold text-secondary">Order Summary</h5>
                            <div class="table-responsive">
                                <table class="table table-borderless table-striped mb-0 rounded shadow-sm">
                                    <thead>
                                        <tr>
                                            <th class="text-left">Product</th>
                                            <th class="text-center">Qty</th>
                                            <th class="text-right total-col">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($items as $item)
                                            <tr>
                                                <td class="text-left">
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ asset($item->associatedModel->featured_image) }}"
                                                            alt="Product"
                                                            style="width:36px; height:36px; object-fit:cover; border-radius:6px; margin-right:8px;">
                                                        <span>{{ $item->name }}</span>
                                                    </div>
                                                </td>
                                                <td class="text-center">{{ $item->quantity }}</td>
                                                <td class="text-right">$ {{ $item->quantity * $item->price }}</td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                    <tfoot>
                                        <tr class="border-top">
                                            <th colspan="2" class="text-right">Subtotal:</th>
                                            <th class="text-right">${{ $total }}</th>
                                        </tr>
                                        <tr>
                                            <th colspan="2" class="text-right">Shipping:</th>
                                            <th class="text-right">Free</th>
                                        </tr>
                                        <tr>
                                            <th colspan="2" class="text-right h5">Total:</th>
                                            <th class="text-right h5 text-success">${{ $total }}</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <!-- Payment Method (below order summary) -->
                        <div class="mb-4">
                            <h5 class="mb-3 font-weight-bold text-primary">Payment Method</h5>
                            <div class="payment-methods d-flex flex-column gap-2">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="payment_method" id="online"
                                        value="online" checked>
                                    <label class="form-check-label" for="online">
                                        <i class="fa fa-credit-card text-primary"></i> Online Payment
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_method" id="cod"
                                        value="cod">
                                    <label class="form-check-label" for="cod">
                                        <i class="fa fa-money-bill text-success"></i> Cash on Delivery
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- Proceed to Payment Button (bottom) -->
                        <button href="#" type="submit" class="btn btn-success w-100 btn-lg">Proceed to Payment</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
