@extends('layout')

@section('content')
    <div class="uper">
{{--        @if ($errors->any())--}}
{{--            <div class="alert alert-danger">--}}
{{--                <ul>--}}
{{--                    @foreach ($errors->all() as $error)--}}
{{--                        <li>{{ $error }}</li>--}}
{{--                    @endforeach--}}
{{--                </ul>--}}
{{--            </div><br />--}}
{{--        @endif--}}

        <div id="product-info">
            <product-info product_id="{{ $product_id }}" add_to_cart_url="{{ $add_to_cart_url }}"></product-info>
        </div>
    </div>
@endsection
