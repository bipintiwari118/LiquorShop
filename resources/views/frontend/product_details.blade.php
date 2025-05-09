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
    </style>
@endsection
@section('content')
    <section class="product-details-section py-5">
        <div class="container">
            <div class="row">
                <!-- Product Image -->
                <div class="col-md-6">
                    <div class="product-image">
                        <img src="{{ asset('/' . $product->image) }}" alt="{{ $product->title }}"
                            class="img-fluid rounded shadow">
                    </div>
                </div>

                <!-- Product Details -->
                <div class="col-md-6">
                    <div class="product-details">
                        @if(Session::has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('success') }}
                        </div>
                        @endif
                        <h1 class="product-title mb-3">{{ $product->title }}</h1>
                        <div class="product-description text-muted mb-4">
                            {!! $product->description !!}
                        </div>
                        <div class="product-price mb-4">
                            @if ($product->compare_price)
                                <span class="text-danger h4">
                                    <del>${{ $product->price }}</del>
                                </span>
                                <span class="text-success h3">${{ $product->compare_price }}</span>
                            @else
                                <span class="text-success h3">${{ $product->price }}</span>
                            @endif
                        </div>
                        <form action="{{ route('add.cart', $product->slug) }}" method="get">
                            @csrf
                            <label for="" style="font-weight: 600;">Quantity:</label>
                            <input placeholder="Enter quantity" type="number" name="quantity" value="1"
                                min="1" max="20" class="form-control mb-2" style="width:35%;">
                          <input type="submit" value="Add To Cart" style="float: left;">
                        </form>
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
                                {!! $product->description  ?? 'No additional information available for this product.'!!}
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
