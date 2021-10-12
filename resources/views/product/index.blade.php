@extends('layouts.app')

@section('content')
<h1>Products</h1>
<div><a href="{{route('products.create');}}">Create</a></div>
<hr />
@foreach ($products as $product)
<div>
    <div>
        <a href="{{route('products.show', ['product' => $product['id']]);}}">

            <img style="width: 400px;" src="{{$product['imageUrl']}}" alt="apple">

        </a>
    </div>
    <div>
        <a href="{{route('products.edit', ['product' => $product['id']])}}">Edit</a>
        <form method="post" action="{{route('products.destroy', ['product' => $product['id']])}}">
            @csrf
            @method('delete')
            <button type="submit">刪除</button>
        </form>
    </div>
    <hr />
</div>
@endforeach

@endsection


@section('inline_js')
@parent
@endsection