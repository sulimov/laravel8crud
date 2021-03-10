@extends('admin.layout')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="card uper">
        <div class="card-header">
            Create new product
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
            <form method="post" action="{{ route('products.store') }}" enctype="multipart/form-data">
                <div class="form-group">
                    @csrf
                    <label for="title">Title:</label>
                    <input type="text" class="form-control" name="title" value="{{ old('title') }}"/>
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea rows=8 class="form-control" name="description">{{ old('description') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="price">Price:</label>
                    <input type="text" class="form-control" name="price" value="{{ old('price') }}"/>
                </div>
                <div class="form-group">
                    <label for="image">Upload new image:</label>
                    <input id="image" type="file" name="image" accept="image/x-png,image/gif,image/jpeg"/>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-secondary" onclick="window.location='{{ route('products.index') }}'">Back</button>
            </form>
        </div>
    </div>
@endsection
