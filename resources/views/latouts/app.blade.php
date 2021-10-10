<html>

<head>
    @include('layouts.meta')
    @include('layouts.css')
    <title>Kobe Meng 的 Laravel</title>
</head>

<body>
    @include('layouts.nav')

    @yield('content')

    @include('layouts.footer')
    @include('layouts.js')

    @section('inline_js')
    @show
</body>

</html>