@extends('layout')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
        /*.product-grid2 {
            text-align: center;
        }
        .product-image {
            width: 250px;
            margin: auto;
        }*/
        .product-image img {
            width: 100%;
        }
        body{
            /*margin-top:20px;*/
            background-color: #fafafa !important;
        }
        @media (min-width: 0) {
            .g-mb-30 {
                margin-bottom: 2.14286rem !important;
            }
        }
        @media (min-width: 0) {
            .g-py-40 {
                padding-top: 2.85714rem !important;
                padding-bottom: 2.85714rem !important;
            }
        }
        @media (min-width: 0) {
            .g-px-20 {
                padding-left: 1.42857rem !important;
                padding-right: 1.42857rem !important;
            }
        }
        @media (min-width: 0){
            .g-mb-5 {
                margin-bottom: 0.35714rem !important;
            }
        }
        .g-bg-white {
            background-color: #fff !important;
        }
        .u-shadow-v18 {
            box-shadow: 0 5px 10px -6px rgba(0, 0, 0, 0.15);
        }
        .g-color-primary {
            color: #72c02c !important;
        }
        .g-font-size-16 {
            font-size: 1.14286rem !important;
        }
        .g-mb-10 {
            margin-bottom: 0.71429rem !important;
        }
        .g-mb-10 {
            margin-bottom: 0.71429rem !important;
        }
        .g-color-black {
            color: #000 !important;
        }
        .g-font-weight-600 {
            font-weight: 600 !important;
        }

        .mb-4 {
            max-height: 300px;
        }
    </style>
    <div class="uper">
        <h2>Products</h2>

        <div class="container">
            <div class="row">
                @foreach($products as $product)
                    <div class="col-md-6 col-lg-4 g-mb-30">
                        <article class="u-shadow-v18 g-bg-white text-center rounded g-px-20 g-py-40 g-mb-5">
                            <a href="{{ route('product-frontpage', ['id' => $product->id]) }}">
                                <img class="d-inline-block img-fluid mb-4" src="{{ $product->mainImageUrl }}" alt="Image Description"/>
                            </a>
                            <h4 class="h5 g-color-black g-font-weight-600 g-mb-10">
                                <a href="{{ route('product-frontpage', ['id' => $product->id]) }}">{{ $product->title }}</a>
                            </h4>
{{--                        <p>Finding your perfect product</p>--}}
                            <span class="d-block g-color-primary g-font-size-16">${{ $product->price }}</span>
                        </article>
                    </div>
{{--                <div class="col-md-4 col-sm-6" style="margin-top: 20px;">--}}
{{--                    <div class="product-grid2">--}}
{{--                        <div class="product-image">--}}
{{--                            <a href="{{ route('product-frontpage', ['id' => $product->id]) }}">--}}
{{--                                <img src="/storage/images/products/{{ $product->image }}">--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                        <div class="product-content">--}}
{{--                            <h3 class="title"><a href="{{ route('product-frontpage', ['id' => $product->id]) }}">{{ $product->title }}</a></h3> <span class="price">${{ $product->price }}</span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
                @endforeach
            </div>
        </div>
    </div>
@endsection
