<form method="post" action="{{route('products.update', ['product' => $product['id']])}}">
    @csrf
    @method('PATCH')
    <input type="text" name="title">
    <button type="submit">送出</button>
</form>