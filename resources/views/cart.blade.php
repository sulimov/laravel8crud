@extends('layout')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
        .cart_product_count {
            width: 65px;
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

        @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div><br />
        @endif

        <h2>Cart</h2>

        @if(!empty($cart))
        <table class="table-cart table table-striped">
            <thead>
                <tr>
                    <td>Product</td>
                    <td>Price</td>
                    <td>Count</td>
                    <td>Total</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>
            @foreach($cart as $product_id => $product)
                <tr>
                    <td><a href="{{ route('product-frontpage', [$product_id]) }}">{{ $product['data']->title }}</a></td>
                    <td>${{ $product['data']->price }}</a></td>
                    <td>
                        <label>
                            <input type="number" class="cart_product_count" value="{{ $product['count'] }}" min="0"/>
                        </label>
                    </td>
                    <td>${{ $product['data']->price * $product['count'] }}</td>
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
            <tr>
                <td colspan="3">Subtotal:</td>
                <td colspan="2">{{ 0 }}</td>
            </tr>
            </tbody>
        </table>
        <div>
            <button type="button" id="cart-update-btn" class="btn btn-warning">Update</button>
            <button type="button" id="cart-clear-btn" class="btn btn-danger">Clear cart</button>
        </div>
        <div style="margin-top: 30px;">
            <a href="{{ route('checkout') }}" class="btn btn-success">Proceed to checkout</a>
        </div>
        @else
            <p>Your cart is empty</p>
        @endif
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
