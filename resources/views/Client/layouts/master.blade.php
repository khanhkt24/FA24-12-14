<!DOCTYPE html>
<html lang="en">

<head>
    @include('Client.layouts.patials.head')
</head>

<body>

    <div class="site-wrap">
        <header class="site-navbar" role="banner">
            @include('Client.layouts.patials.header')
        </header>

        @yield('content')

        <footer class="site-footer border-top">
            @include('Client.layouts.patials.footer')
        </footer>
    </div>

    @include('Client.layouts.patials.js-cient')


</body>

</html>
