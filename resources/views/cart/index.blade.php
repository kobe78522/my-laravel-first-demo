@extends('layouts.app')

@section('content')

<h1>購物車列表</h1>
<form action="{{route('cart.cookie.update')}}" method="post">
    @csrf
    @method('PATCH')

    <table border="1">
        <thead>
            <tr>
                <th>產品項目</th>
                <th>價錢</th>
                <th>數量</th>
                <th>刪除</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cartItems as $cartItem)
            <tr>
                <td>
                    <p>{{$cartItem["productInfo"]["name"]}}</p>
                    <img src='{{$cartItem["productInfo"]["imageUrl"]}}' alt='pic' style="width: 100px;">
                </td>
                <td>$ {{$cartItem["productInfo"]["price"]}}</td>
                <td>
                    <input type="number" name='product_{{$cartItem["productInfo"]["id"]}}' min="1" value="{{$cartItem['quantity']}}">
                </td>
                <td>
                    <button type="button" class="cartDeleteBtn" data-id="{{$cartItem['productInfo']['id']}}">刪除</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <hr>
    <button type="submit">更新</button>
</form>

@endsection

@section('inline_js')
@parent
<script>
    initCartDeleteButton("{{route('cart.cookie.delete')}}")
</script>
@endsection