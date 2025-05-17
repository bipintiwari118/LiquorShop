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

        .cartsuccess {
            color: rgb(27, 146, 27);
        }

         .carterror {
            color: red;
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

        @media (max-width: 991.98px) {
            .checkout-section {
                margin-top: 30px;
            }
        }

        @media (max-width: 767.98px) {
            .cart-section h1 {
                font-size: 1.3rem;
            }

            .table th,
            .table td {
                font-size: 0.95rem;
                padding: 0.4rem;
            }

            .checkout-section {
                padding: 10px;
            }

            .input-group.input-group-sm>.form-control,
            .input-group.input-group-sm>.btn {
                font-size: 0.95rem;
                padding: 0.25rem 0.5rem;
            }
        }

        @media (max-width: 575.98px) {

            .table th,
            .table td {
                font-size: 0.85rem;
                padding: 0.25rem;
            }

            .checkout-section {
                padding: 7px;
            }
        }
    </style>
@endsection


@section('content')
    <section class="cart-section py-5">
        <div class="container">
            <h1 class="mb-4 text-center">Your Shopping Cart</h1>
            <div class="row">
                <!-- Cart Table -->
                <div class="col-lg-8 mb-4 mb-lg-0">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-3">
                        <h4 class="mb-2 mb-md-0">Your Cart Items</h4>
                        @if (Session::has('success'))
                            <div class="text-[20px] mt-1 p-[20px] cartsuccess" role="alert">
                                {{ Session::get('success') }}
                            </div>
                        @endif
                        @if (Session::has('error'))
                            <div class="text-[20px] mt-1 p-[20px] carterror" role="alert">
                                {{ Session::get('error') }}
                            </div>
                        @endif
                        <a href="{{ route('cart.clear') }}" class="btn btn-danger btn-sm mt-2 mt-md-0"
                            onclick="return confirm('Are you sure you want to remove all items from your cart?')">
                            Clear All
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover w-100 mb-0">
                            <thead class="table-dark text-nowrap">
                                <tr>
                                    <th>Image</th>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Sub Total</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                    <tr>
                                        <td class="align-middle">
                                            <img src="{{ asset($item->associatedModel->featured_image) }}"
                                                alt="Product Image" class="img-fluid" style="max-width:60px;">
                                        </td>
                                        <td class="align-middle">{{ $item->name }}</td>
                                        <td class="align-middle">
                                            <div class="input-group input-group-sm flex-nowrap" style="width: 110px;">
                                                <button type="button" class="btn btn-outline-secondary btn-sm btn-qty"
                                                    data-id="{{ $item->id }}" data-action="decrease">-</button>
                                                <input id="quantity-{{ $item->id }}" type="text"
                                                    value="{{ $item->quantity }}" min="1" max="50"
                                                    class="form-control form-control-sm text-center" style="width: 40px;"
                                                    readonly>
                                                <button type="button" class="btn btn-outline-secondary btn-sm btn-qty"
                                                    data-id="{{ $item->id }}" data-action="increase">+</button>
                                            </div>
                                        </td>
                                        <td class="align-middle">$ {{ $item->price }}</td>
                                        <td class="align-middle subtotal" id="subtotal-{{ $item->id }}">
                                            ${{ $item->quantity * $item->price }}</td>
                                        <td class="align-middle">
                                            <a href="{{ route('cart.remove', $item->id) }}"
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
                    <div class="checkout-section mt-4 mt-lg-0">
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
                        <a href="{{ route('check.out') }}" class="btn btn-success w-100">Proceed to Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>


        $('.btn-qty').click(function() {
            var id = $(this).data('id');
            var action = $(this).data('action');
            $.ajax({
                url: "{{ url('/cart/update-ajax') }}/" + id,
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    action: action
                },
                success: function(response) {
                    // Update quantity and subtotal in the DOM
                    $('#quantity-' + id).val(response.quantity);
                    $('#subtotal-' + id).text('$' + response.subtotal);
                    // Optionally update total
                    if (response.total) {
                        $('#total-price').text('$' + response.total);
                        $('#total-price-final').text('$' + response.total);
                    }
                }
            });
        });
    </script>
@endpush
