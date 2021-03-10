<template>
    <div>
        <form method="post" enctype="multipart/form-data">
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
</template>

<script>
    import products_table_row from "./products_table_row";

    export default {
        name: "products_table",

        components: {
            products_table_row
        },

        data () {
            return {
                products: []
            }
        },

        mounted () {
            this.loadProducts()
        },

        methods: {
            loadProducts: function () {
                axios
                    .get('/api/admin/getProductsTableData')
                    .then(response => {
                        this.products = response.data
                        // console.log('success')
                        // console.log(response.data)
                    })
                    .catch(error => {
                        // console.log('error')
                        console.log(error)
                        // this.errored = true
                    })
            }
        }
    }
</script>
