@extends('layouts.app')

@section('content')
<h1>My product</h1>
<img class="my-bg" src="{{$product['imageUrl']}}" alt="apple">
@endsection

@section('inline_js')
@parent
@endsection