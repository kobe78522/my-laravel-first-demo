@extends('layouts.app')

@section('content')
<div class="main">This is PBpage {{$ver}}</div>

<div class="main">my level : {{$lv}}</div>
@endsection

@section('inline_js')
@parent
@endsection