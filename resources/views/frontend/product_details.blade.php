@extends('frontend.layout.app')
@section('styles')
    <style>
        .product-title {
            font-size: 2.5rem;
            font-weight: bold;
        }

        .product-description {
            font-size: 1.1rem;
            line-height: 1.6;
        }

        .product-price .h4 {
            margin-right: 10px;
        }

        .product-actions .btn {
            border-radius: 30px;
        }

        .nav-tabs .nav-link {
            font-size: 1.1rem;
            font-weight: bold;
        }

        .nav-tabs .nav-link.active {
            color: #fff;
            background-color: #007bff;
            border-color: #007bff;
        }

        .product-price .badge-success {
            background-color: #28a745;
            color: #fff;
            padding: 0.5em 1em;
            border-radius: 20px;
        }

        .product-title {
            font-size: 2.7rem;
            font-weight: 800;
            letter-spacing: 1px;
            margin-bottom: 1rem;
            color: #1a237e;
            /* Deep blue */
            text-align: left;
            line-height: 1.1;
            background: none;
            border: none;
            text-shadow: 0 2px 8px rgba(30, 136, 229, 0.10);
            display: block;
            padding-bottom: 0;
        }
    </style>
@endsection
@section('content')
    <section class="product-details-section py-5">
        <div class="container">
            <div class="row">
                <!-- Product Image -->
                <div class="col-md-6">
                    <div class="product-image d-flex align-items-center justify-content-center"
                        style="width:320px; height:320px; background:#f8f9fa; border-radius:16px; overflow:hidden;">
                        <img src="{{ asset($product->featured_image) }}" alt="{{ $product->title }}" class="img-fluid"
                            style="max-width:100%; max-height:100%; object-fit:contain; display:block; margin:auto;">
                    </div>
                </div>

                <!-- Product Details -->
                <div class="col-md-6">
                    <div class="product-details">
                        @if (Session::has('success'))
                            <div class="alert alert-success" role="alert">
                                {{ Session::get('success') }}
                            </div>
                        @endif
                        <h1 class="product-title mb-3">{{ $product->title }}
                        </h1>
                        <ul class="list-unstyled mb-4">
                            <li><strong>Brand:</strong> {{ $product->brand ?? 'N/A' }}</li>
                            <li><strong>Volume:</strong> {{ $product->volume ?? 'N/A' }}</li>
                            <li><strong>Alcohol Percentage:</strong> {{ $product->alcohol ?? 'N/A' }}</li>
                            <li><strong>Category:</strong> {{ $product->category ?? 'N/A' }}</li>
                        </ul>
                        <div class="product-price mb-4 d-flex align-items-center" style="gap: 15px;">
                            <span class="h3 text-success" style="font-weight: bold;">
                                ${{ number_format($product->price, 2) }}
                            </span>

                        </div>

                            <a href="" type="submit" class="btn btn-primary" style="margin-left: 10px;">Add To Cart</a>
                    </div>
                </div>
            </div>

            <!-- Tabs for Additional Information and Reviews -->
            <div class="row mt-5">
                <div class="col-12">
                    <ul class="nav nav-tabs" id="productDetailsTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="additional-info-tab" data-toggle="tab" href="#additional-info"
                                role="tab" aria-controls="additional-info" aria-selected="true">Additional
                                Information</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="reviews-tab" data-toggle="tab" href="#reviews" role="tab"
                                aria-controls="reviews" aria-selected="false">Reviews</a>
                        </li>
                    </ul>
                    <div class="tab-content mt-4" id="productDetailsTabContent">
                        <!-- Additional Information Tab -->
                        <div class="tab-pane fade show active" id="additional-info" role="tabpanel"
                            aria-labelledby="additional-info-tab">
                            <p class="text-muted">
                                {!! $product->description ?? 'No additional information available for this product.' !!}
                            </p>
                        </div>
                        <!-- Reviews Tab -->
                        <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                            <p class="text-muted">No reviews available for this product yet.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@push('scripts')
<script>
    function changeQty(amount) {
        var qtyInput = document.getElementById('quantity');
        var current = parseInt(qtyInput.value) || 1;
        var min = parseInt(qtyInput.min) || 1;
        var max = parseInt(qtyInput.max) || 20;
        var next = current + amount;
        if (next >= min && next <= max) {
            qtyInput.value = next;
        }
    }
</script>
@endpush
