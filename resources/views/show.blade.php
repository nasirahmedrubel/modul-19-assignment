@extends('layouts.master')

@section('content')
<div class="container mt-4">
    <div class="row">

        <div class="col-md-4">
            <img src="{{asset('images/'.$product->image)}}" alt="" class="prdtImage">
        </div>
        <div class="col-md-8">
            <div class="col-12 breadcrumbs d-flex">
                <a href="{{route('product')}}">Home</a> / <span>{{$product->product_id}}</span>
            </div>
            <h3>{{$product->name}}</h3>
            <h4>Price : {{$product->price}}</h4>
            <h6 class="mt-3">Stock : {{$product->stock}}</h6>
        </div>
    </div>
    <div class="row mt-3">
        <p>{{$product->description}}</p>
    </div>
</div>
@endsection
