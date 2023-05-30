<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Base Laravel</title>

    @include('layouts.styles')

    @yield('css')

</head>

<body class="hold-transition sidebar-mini">

    <!-- Site wrapper -->
    <div class="wrapper">

        @include('layouts.navbar')

        @include('layouts.aside')

        <div class="content-wrapper pt-2">
            @yield('content')
        </div>

        @include('layouts.footer')

        @include('layouts.control')

    </div>

    @include('layouts.scripts')

    @yield('js')

</body>

</html>
