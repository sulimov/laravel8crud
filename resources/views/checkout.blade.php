@extends('layout')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
        .checkout-fields input{
            width: 200px;
        }
        input[name=address] {
            width: 350px;
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

        <h2>Checkout</h2>
        <br/>
        <h3>Cart</h3>
        @if(!empty($cart))
        <table class="table-cart table table-striped">
            <thead>
                <tr>
                    <td>Product</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Total</td>
                </tr>
            </thead>
            <tbody>
            @foreach($cart as $product_id => $product)
                <tr>
                    <td><a href="{{ route('product-frontpage', [$product_id]) }}">{{ $product['data']->title }}</a></td>
                    <td>${{ $product['data']->price }}</td>
                    <td>{{ $product['count'] }}</td>
                    <td>${{ $product['data']->price * $product['count'] }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div>
            <a href="{{ route('cart') }}" class="btn btn-info">Return to cart</a>
        </div>
        @else
            <p>Your cart is empty</p>
        @endif
    </div>

    <br/><br/>

    <h3>Checkout info</h3>

    <div class="checkout-fields" style="margin-top: 20px">
        <form action="{{ route('create_order') }}" method="post">
            @csrf
            <div>
                <label>
                    <div>Name:</div>
                    <input type="text" name="name" value="{{ old('name') }}" required/>
                </label>
            </div>
            <div>
                <label>
                    <div>Phone:</div>
                    <input type="text" name="phone" value="{{ old('phone') }}"/>
                </label>
            </div>
            <div>
                <label>
                    <div>E-mail:</div>
                    <input type="text" name="email" value="{{ old('email') }}"/>
                </label>
            </div>
            <br/>
            <div>
                <label>
                    <div>Address:</div>
                    <input type="text" name="address" value="{{ old('address') }}"/>
                </label>
            </div>
            <div>
                <button type="submit" class="btn btn-success">Create order</button>
            </div>
        </form>
    </div>

    <script>
        $('#cart-update-btn').on('click', function (){
            // alert('Please be patient')
            let cart = {};
            $('table.table-cart tbody tr').each(function(i, e){
                let id = $(e).find('input[name=product_id]').val();
                cart[id] = $(e).find('.cart_product_count').val();
            });

            $.ajax({
                'url': '{{ route('update_cart') }}',
                'type': 'POST',
                'data': {'cart': cart},
                'dataType': 'json',
                'success': function (data){
                    if (data.status === 'success'){
                        location.reload();
                    } else {
                        alert(data.msg);
                    }
                }
            })
        });

        $('#cart-clear-btn').on('click', function (){
            alert('Please be patient')
        });
    </script>
@endsection
