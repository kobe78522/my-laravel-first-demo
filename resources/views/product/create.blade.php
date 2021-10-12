<form method="post" action="{{route('products.store')}}">
    @csrf
    <input type="text" name="title">
    <button type="submit">送出</button>
</form>