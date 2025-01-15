@extends('layouts.master')

@section('content')
<div class="container mt-3">

    <div class="row">
        @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                {{session()->get('success')}} &nbsp;<strong>Successfully.</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="col-md-12 input-group mb-3">
            <input type="text" class="form-control" name="search" placeholder="Search Prouct" id="search">
            <span class="input-group-text" id="basic-addon2">Search Product</span>
        </div>

        <div class="col-12 d-flex justify-content-end mb-3">
            <a href="{{route('product.create')}}" class="btn btn-info">Create Product</a>
        </div>
    </div>

    <div class="row mb-3">
        <div class="d-flex gap-3">
            <div class="div">
                <div class="btn-group" role="group">
                    <input type="radio" class="btn-check" name="filterName" id="name" value="name" checked>
                    <label class="btn btn-outline-primary" for="name">Name</label>

                    <input type="radio" class="btn-check" name="filterName" id="price" value="price">
                    <label class="btn btn-outline-primary" for="price">Price</label>
                </div>
            </div>

            <div class="div">
                <div class="btn-group" role="group">
                    <input type="radio" class="btn-check" name="filterValue" id="asc" value="asc" checked>
                    <label class="btn btn-outline-primary" for="asc">Acs</label>

                    <input type="radio" class="btn-check" name="filterValue" id="desc" value="desc">
                    <label class="btn btn-outline-primary" for="desc">Desc</label>
                </div>
            </div>
        </div>


    </div>


    <div class="row">
        <div class="col-12 mb-3">
            <div class="card">
                <div class="card-header">
                    Product List
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Description</th>
                                    <th>Image</th>
                                    <th>stock</th>
                                    <th>Price</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody id="tblbody">
                                @php
                                    $count = 1;
                                @endphp
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{$count++}}</td>
                                        <td><a href="{{route('product.view', ['id' => $product->product_id])}}" class="d-flex align-content-center">{{$product->name}}</a></td>
                                        <td>{{$product->product_id}} </td>
                                        <td>{{$product->description}}</td>
                                        <td>
                                            <img src="{{asset('images/'.$product->image)}}" alt="" width="60" height="60">

                                        </td>
                                        <td>{{$product->stock}}</td>
                                        <td>{{$product->price}}</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{route('product.edit', ['id' => $product->id])}}" class="btn btn-info">Edit</a>
                                                <form action="{{route('product.delete', ['id' => $product->id])}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-12">
            {{ $products->links() }}
        </div>
    </div>

</div>
@endsection


@section('extra-js')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
$(document).ready(function(){
  $("#search").change(function(){
    let searchValue = $('#search').val();
    $.ajax({
        url: "{{ route('product') }}",
        type: 'get',
        dataType: "json",
        data: {
            search: searchValue,
        },
        success: function(data) {
            // log response into console
            $('#tblbody').html(data.html);
            // alert(data.html);
        }
    });
  });

  function filtering(){
    let filterName = $("input[name='filterName']:checked").val();
    let filterValue = $("input[name='filterValue']:checked").val();
    $.ajax({
        url: "{{ route('product') }}",
        type: 'get',
        dataType: "json",
        data: {
            filterName: filterName,
            filterValue: filterValue,
        },
        success: function(data) {
            // log response into console
            $('#tblbody').html(data.html);
            // alert(data.filterName + " And " + data.filterValue);
        }
    });
  }

    $("input[name='filterName']").on('click', function(){
        filtering();
    });
    $("input[name='filterValue']").on('click', function(){
        filtering();
    });
});
</script>


@endsection
