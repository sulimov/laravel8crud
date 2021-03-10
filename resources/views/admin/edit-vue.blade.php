@extends('admin.layout')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="card uper">
        <div class="card-header">
            Edit Product Data
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br />
            @endif
            <form method="post" action="{{ route('products.update', $product->id ) }}" enctype="multipart/form-data">
                <div class="form-group">
                    @csrf
                    @method('PATCH')
                    <label for="title">Product Title:</label>
                    <input type="text" class="form-control" name="title" value="{{ $product->title }}"/>
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea rows=8 class="form-control" name="description">{{ $product->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="price">Price:</label>
                    <input type="text" class="form-control" name="price" value="{{ $product->price }}"/>
                </div>
                <div class="form-group">
                    <label for="image">Upload new image:</label>
                    <input id="image" type="file" name="image" accept="image/x-png,image/gif,image/jpeg"/>
                    {{--<div>
                        @if($product->images)
                            @forelse($product->images as $image)
                                <img height="300" src="{{ $image->getImageUrl() }}"/>
                            @empty
                                <p>No images</p>
                            @endforelse
                        @endif
                    </div>--}}

{{--                <div class="form-group">--}}
{{--                    <label for="image">Additional images</label>--}}
{{--                    <input id="additional_images" type="file" name="additional_images" accept="image/x-png,image/gif,image/jpeg"/>--}}
{{--                    @if ($product->additionalImages)--}}

{{--                    @endif--}}
{{--                </div>--}}

                    @if(!$product->images->isEmpty())
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <td>{{--<button type="button" class="btn btn-danger">Delete</button>--}}</td>
                                    <td>Image</td>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($product->images as $image)
                                <tr>
                                    <td><img height="300" src="{{ $image->getImageUrl() }}" alt=""/></td>
                                    <td>
{{--                                        <input type="checkbox" data-id="{{ $image->id }}" class="image-checkbox" />--}}
                                        <button type="button" data-id="{{ $image->id }}" class="delete_image_button btn btn-danger">Delete</button>
                                        {{--                                        <form action="{{ route('product_image_delete', [$product->id, $image->id]) }}" method="post">--}}
                                        {{--                                            @csrf--}}
                                        {{--                                            @method('DELETE')--}}
                                        {{--                                            <button class="btn btn-danger" type="submit">Delete</button>--}}
                                        {{--                                        </form>--}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>No images</p>
                    @endif
                </div>

                <div>
                    <button type="submit" class="btn btn-primary">Update Data</button>
                    <button type="button" class="btn btn-secondary" onclick="window.location='{{ route('products.index') }}'">Back</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        $('.delete_image_button').on('click', function (e){
            let button = $(this); //image_id = $(this).data('id'),

            $.ajax({
                'url': '{{ route('product_image_delete', $product->id) }}',
                'type': 'DELETE',
                'data': {'image_id' : $(button).data('id')},
                'dataType': 'json',
                'success': function (data){
                    if (!data || !data.hasOwnProperty('success')){
                        alert('Error while deleting the image. See Console output');
                        console.log(data);
                        return;
                    }

                    if (data.success){
                        // Remove table's row
                        $(button).parent().parent().remove();
                    } else {
                        alert('Can not delete this image. Please try to refresh the page')
                    }
                }
            });
        });
    </script>
@endsection
