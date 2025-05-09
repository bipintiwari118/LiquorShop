@extends('frontend.layout.app')
@section('content')
    <!-- inner page section -->
    <section class="inner_page_head">
        <div class="container_fuild">
            <div class="row">
                <div class="col-md-12">
                    <div class="full">
                        <h3>Product Grid</h3>
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
                    Our <span>products</span>
                </h2>
            </div>
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="box">
                            <div class="option_container">
                                <div class="options">
                                    <a href="{{ route('product.details', $product->slug) }}" class="option1">
                                        Product Details
                                    </a>
                                <a href="{{ route('add.cart',$product->id) }}" class="btn btn-primary" class="option1">Add cart</a>
                                </div>
                            </div>
                            <div class="img-box">
                                <img src="{{ asset('/' . $product->image) }}" alt="">
                            </div>
                            <div class="detail-box">
                                <h5>
                                    {{ $product->title }}
                                </h5>
                                <h6>
                                    @if ($product->compare_price)
                                        <del style="color: red;">${{ $product->price }}</del>
                                        ${{ $product->compare_price }}
                                    @else
                                        ${{ $product->price }}
                                    @endif
                                </h6>


                            </div>
                        </div>
                    </div>
                @endforeach



            </div>
            {{-- Pagination links --}}
            <div class="mt-4">
                {{-- Check if the products collection has more than one page --}}
                {{ $products->links() }}
            </div>

        </div>
    </section>
    <!-- end product section -->
@endsection
