<!doctype html>
<html lang="en">
@include("layouts._head")
<title>@yield('title')</title>
<body data-theme="light">

@include('layouts._nav')

@yield('content')


@include('layouts._scripts')
</body>
</html>
