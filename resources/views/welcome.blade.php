<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Inicio</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>

    <link rel="stylesheet" href="{{ asset('css/tailwind.css') }}">
    <link href="{{ asset('images/favicon.png') }}" rel="icon" type="image/png">
</head>
<body>
@include('header')
<div class="container mx-auto">

    <div class="mx-2 my-2">
        @include('flash::message')
    </div>
    @yield('content')
</div>

@include('footer')

<script src="//code.jquery.com/jquery.js"></script>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script>
    $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
</script>
</body>
</html>
