@php
$count = 1;
@endphp
@foreach ($searchProducts as $product)
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
                <button type="submit" class="btn btn-primary">delete</button>
            </form>
        </div>
    </td>
</tr>
@endforeach

