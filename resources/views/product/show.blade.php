@extends('layouts.app')

@section('content')
<h1>{{$product['name']}}</h1>
<img style="width: 400px;" src="{{$product['imageUrl']}}" alt="apple">
<div style="margin: 36px 0;">
    <h3>Price: {{$product['price']}}</h3>
    <input type="number" name="qty" min="1" value="1">
    <button type="button" id="addToCart">加入購物車</button>
</div>
<div><a href="/products">回產品首頁</a></div>
@endsection

@section('inline_js')
@parent
<script>
    var productId = "{{$product['id']}}";
    initAddtoCart(productId);
</script>
@endsection