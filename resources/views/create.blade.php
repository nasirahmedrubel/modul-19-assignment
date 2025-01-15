@extends('layouts.master')
@section('content')
<div class="container">
    <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
    @csrf
        <div class="row my-3">
            <div class="col-md-12 d-flex justify-content-end">
                <a href="{{route('product')}}" class="btn btn-dark">Back</a>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                Create Product
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-8 p-3">
                        <div class="mb-3">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control">
                            @error('name')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="slug">Slug</label>
                            <input type="text" name="slug" id="slug" class="form-control">
                            @error('slug')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
                            @error('description')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="image">image</label>
                            <input type="file" name="image" id="image" class="form-control">
                            @error('image')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-4 p-3">
                        <div class="mb-3">
                            <label for="price">Price</label>
                            <input type="text" name="price" id="name" class="form-control">
                            @error('price')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="stock">Stock</label>
                            <input type="text" name="stock" id="stock" class="form-control">
                            @error('stock')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3 d-grid">
                            <button type="submit" class="btn btn-primary d-block">Submit</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>


    </form>
</div>
@endsection
