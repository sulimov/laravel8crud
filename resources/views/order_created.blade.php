@extends('layout')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
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
            </div>
        @endif

        <h2>Order created</h2>

        {{--@if(!empty($cart))
        <table class="table-cart table table-striped">
            <thead>
                <tr>
                    <td>Product</td>
                    <td>Count</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>
            @foreach($cart as $product_id => $product)
                <tr>
                    <td><a href="{{ route('product-frontpage', [$product_id]) }}">{{ $product['data']->title }}</a></td>
                    <td>
                        <label>
                            <input type="number" class="cart_product_count" value="{{ $product['count'] }}" min="0"/>
                        </label>
                    </td>
                    <td>
                        <form action="{{ route('delete_product_from_cart') }}" method="post">
                            @csrf
                            @method('DELETE')
                            <input name="product_id" type="hidden" value="{{ $product['data']->id }}"/>
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div>
            <button type="button" id="cart-update-btn" class="btn btn-warning">Update</button>
            <button type="button" id="cart-clear-btn" class="btn btn-danger">Clear cart</button>
        </div>
        <div style="margin-top: 30px;">
            <button type="button" class="btn btn-success">Proceed to checkout</button>
        </div>
        @else
            <p>Your cart is empty</p>
        @endif--}}
    </div>
@endsection
