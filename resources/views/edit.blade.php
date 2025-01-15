@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row my-3">
        <div class="col-md-12 d-flex justify-content-end">
            <a href="{{route('product')}}" class="btn btn-dark">Back</a>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            Product Update
        </div>
        <div class="card-body">
            <form action="{{route('product.update',['id' => $products->id])}}" method="post" enctype="multipart/form-data">
                @csrf
                @method("PUT")
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="name">Name</label>

                        <input type="text" name="name" id="name" class="form-control" value="{{$products->name}}">

                        @error('name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="slug">Slug</label>

                        <input type="text" name="slug" id="slug" class="form-control" value="{{$products->product_id}}">

                        @error('slug')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description">Description</label>

                        <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{$products->description}}</textarea>

                        @error('description')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="image">image</label>
                        <input type="file" name="image" id="image" class="form-control mb-3">
                        <img src="{{asset('images/'.$products->image)}}" alt="{{$products->image}}" width="200" height="200">
                        @error('image')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 px-3">
                    <div class="mb-3">
                        <label for="price">Price</label>
                        <input type="text" name="price" id="price" class="form-control" value="{{$products->price}}">
                        @error('price')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="stock">Stock</label>
                        <input type="text" name="stock" id="stock" class="form-control" value="{{$products->stock}}">
                        @error('stock')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3 d-grid">
                        <button type="submit" class="btn btn-primary d-block">Update</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>

</div>
@endsection
