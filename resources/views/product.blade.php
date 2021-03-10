@extends('layout')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
        #productImagesSlider {
            width: 400px;
            /*height: 400px;*/
            /*float: left;*/
        }
        .product-image img {
            width: 100%;
        }
        .product-info {
            margin-top: 10px;
            /*margin-left: 420px;*/
            width: 50%;
        }
        .product-info h2 {
            font-weight: bold;
        }
    </style>
    <div class="uper">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div><br />
        @endif

        @if ($product->images)
        <div id="productImagesSlider" class="carousel slide" {{--data-ride="carousel"--}}>
            <ol class="carousel-indicators">
                @foreach($product->images as $image)
                <li data-target="#productImagesSlider" data-slide-to="{{ $loop->index }}" @if ($loop->first) class="active" @endif></li>
                @endforeach
            </ol>
            <div class="carousel-inner">
                @foreach($product->images as $image)
                <div class="carousel-item @if ($loop->first) active @endif">
                    <img class="d-block w-100" src="{{ $image->getImageUrl() }}" alt="">
                </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#productImagesSlider" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#productImagesSlider" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        @endif
        <div class="product-info">
            <h2>{{ $product->title }}</h2>
            <h4>${{ $product->price }}</h4>
            <hr>
            <p>{{ $product->description }}</p>
            <hr>
            <div>
                <form action="{{ route('add_to_cart') }}" method="post">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}"/>
                    <label>
                        <input type="number" name="count" style="width: 60px;" value="1" min="1"/>
                    </label>
                    <button id="add-to-cart" class="btn btn-success" type="submit">Add to cart</button>
                </form>
            </div>
        </div>
    </div>
@endsection
