<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('frontend._include.head')
    </head>
    <body>
        @include('frontend._include.header')
        @include('frontend._include.messages')
        @yield('content')
    </body>
</html>

@include('frontend._include.footer')
