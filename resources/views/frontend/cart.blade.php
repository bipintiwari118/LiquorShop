@extends('frontend.layout.app')

@section('styles')
    <style>
        /* General Styling */
        .cart-section {
            background-color: #f8f9fa;
        }

        .table img {
            border-radius: 5px;
            width: 80px;
            height: auto;
        }

        .table th,
        .table td {
            vertical-align: middle;
            text-align: center;
        }

        .table th {
            background-color: #343a40;
            color: #fff;
        }

        /* Button Styling */
        .btn-primary {
            background-color: #007bff;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .btn-success {
            background-color: #28a745;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        /* Checkout Section */
        .checkout-section {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .checkout-section h4 {
            font-weight: 600;
        }

        .checkout-section .btn {
            width: 100%;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .table-responsive {
                overflow-x: auto;
            }

            .btn {
                font-size: 0.9rem;
                padding: 0.5rem 1rem;
            }

            .checkout-section {
                margin-top: 20px;
            }
        }
    </style>
@endsection

@section('content')
    <section class="cart-section py-5">
        <div class="container">
            <h1 class="mb-4 text-center">Your Shopping Cart</h1>

            @if (Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{ Session::get('success') }}
                </div>
            @endif

            <div class="row">
                <!-- Cart Table -->
                <div class="col-lg-8">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4>Your Cart Items</h4>
                        <a href="" class="btn btn-danger btn-sm"
                            onclick="return confirm('Are you sure you want to remove all items from your cart?')">
                            Clear All
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">Image</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Sub Total</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($items as $item)
                                    <tr>
                                        <td>
                                            <img src="{{ $item->attributes->image }}" alt="{{ $item->attributes->image }}"
                                                class="img-fluid">
                                        </td>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            <a href="{{ route('sub.quantity',$item->id) }}" class="btn btn-sm btn-outline-secondary update-quantity sub"
                                                data-slug="" data-action="decrease">
                                                <i class="fa fa-minus-circle" aria-hidden="true"></i>
                                            </a>
                                            <input type="text" class="mx-2 quantity" value="{{ $item->quantity }}"
                                                style="width: 50px; text-align: center;" readonly>
                                            <a href="{{ route('add.quantity',$item->id) }}" class="btn btn-sm btn-outline-secondary update-quantity add"
                                                data-slug="" data-action="increase">
                                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                        <td>$ {{ $item->price }}</td>
                                        <td class="subtotal">$ {{ $item->quantity * $item->price }}</td>
                                        <td>
                                            <a href=""
                                                class="btn btn-sm btn-danger text-white rounded-sm"
                                                onclick="return confirm('Are you sure to remove this item?')">Remove</a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Checkout Section -->
                <div class="col-lg-4">
                    <div class="checkout-section">
                        <h4 class="mb-4">Cart Total</h4>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Subtotal:</span>
                            <span id="total-price">$ {{ $total }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Shipping:</span>
                            <span>Free</span>
                        </div>
                        <div class="d-flex justify-content-between mb-4">
                            <strong>Total:</strong>
                            <strong id="total-price-final">$ {{ $total }}</strong>
                        </div>
                        <a href="" class="btn btn-success">Proceed to Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script></script>
@endpush
