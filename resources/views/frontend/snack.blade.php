@extends('frontend.layout.app')
@section('content')
    <!-- inner page section -->
    <section class="inner_page_head">
        <div class="container_fuild">
            <div class="row">
                <div class="col-md-12">
                    <div class="full">
                        <h3>Our Best Selling Snacks</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end inner page section -->
    <!-- product section -->
    <section class="product_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>
                    Our <span>Snacks</span>
                </h2>
            </div>
            <div class="row">
                @foreach ($snacks as $snack)
                    <div class="col-sm-6 col-md-4 col-lg-4">
                        <div class="box">
                            <div class="option_container">
                                <div class="options">
                                    <a href="" class="option1">
                                        Add to Cart
                                    </a>
                                    <a href="{{ route('product.details',$snack->slug) }}" class="option2">
                                        Product Details
                                    </a>
                                </div>
                            </div>
                            <div class="img-box">
                                <img src="{{ asset($snack->featured_image) }}" alt="">
                            </div>
                            <div class="detail-box">
                                <h5>
                                    {{ $snack->title }}
                                </h5>
                                <h6>
                                    ${{ $snack->price }}
                                </h6>
                            </div>
                        </div>
                    </div>
                @endforeach



            </div>
            {{-- Pagination links --}}
            <div class="mt-4">
                {{-- Check if the products collection has more than one page --}}
                {{ $snacks->links() }}
            </div>

        </div>
    </section>
    <!-- end product section -->
@endsection
