@extends('layouts.app')

@section('content')
<h1>Products</h1>

@foreach ($products as $product)

<a href="{{route('products.show', ['product' => $product['id']]);}}">

    <img style="width: 400px;" src="{{$product['imageUrl']}}" alt="apple">

</a>
<br />
@endforeach

@endsection


@section('inline_js')
@parent
@endsection