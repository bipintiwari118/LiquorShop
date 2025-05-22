@extends('frontend.layout.app')

@section('content')
    <section class="inner_page_head">
        <div class="container_fuild">
            <div class="row">
                <div class="col-md-12">
                    <div class="full">
                        <h3>Contact us</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end inner page section -->
    <!-- why section -->
    <section class="why_section layout_padding">
        <div class="container">

            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="full">
                        @if (Session::has('success'))
                            <div  role="alert" style="padding-bottom:10px;color:green;">
                                {{ Session::get('success') }}
                            </div>
                        @endif
                        <form action="{{ route('contact.submit') }}" method="POST">
                            @csrf
                            <fieldset>
                                <input type="text" placeholder="Enter your full name" name="name" required />
                                <input type="email" placeholder="Enter your email address" name="email" required />
                                <input type="text" placeholder="Enter subject" name="subject" required />
                                <textarea placeholder="Enter your message" name='message' required></textarea>
                                <input type="submit" value="Submit" />
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end why section -->
    <!-- arrival section -->
    <section class="arrival_section">
        <div class="container">
            <div class="box">
                <div class="arrival_bg_box">
                    <img src="{{ asset('frontend/images/arrival-bg.png') }}" alt="">
                </div>
                <div class="row">
                    <div class="col-md-6 ml-auto">
                        <div class="heading_container remove_line_bt">
                            <h2>
                                #NewArrivals
                            </h2>
                        </div>
                        <p style="margin-top: 20px;margin-bottom: 30px;">
                            Discover a wide range of liquor at our shop — from smooth whisky to crisp beer and fine wine.
                            Perfect for every celebration or a quiet evening at home. Great taste, fair prices, and trusted
                            quality all in one place.
                        </p>
                        <a type="button" href="{{ route('beer.show') }}">
                            Shop Now
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
