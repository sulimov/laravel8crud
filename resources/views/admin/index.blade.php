@extends('admin.layout')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
        .create-product-btn {
            margin-top: 10px;
            margin-bottom: 10px;
        }
    </style>
    <div class="uper">
        <h2>Products</h2>

        @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div><br />
        @endif

        <div>
            <button type="button" class="create-product-btn btn btn-success" onclick="window.location='{{ route('products.create') }}'">New product</button>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Product Title</td>
                    <td>Product Price</td>
                    <td colspan="2">Action</td>
                </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{$product->id}}</td>
                    <td>{{$product->title}}</td>
                    <td>{{$product->price}}</td>
                    <td><a href="{{ route('products.edit', $product->id)}}" class="btn btn-primary">Edit</a></td>
                    <td>
                        <form action="{{ route('products.destroy', $product->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div>
@endsection
