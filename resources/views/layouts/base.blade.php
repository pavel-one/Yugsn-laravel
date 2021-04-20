<!DOCTYPE html>
<html lang="ru">
<x-head title="test"></x-head>
<body
    class="@yield('body-class', 'home blog blog-post-transparent-header-disable blog-small-page-width blog-enable-images-animations blog-enable-sticky-sidebar blog-enable-sticky-header blog-style-corners-rounded')">

<x-top-bar></x-top-bar>
<x-menu></x-menu>

@yield('content')

<x-footer></x-footer>
@if(Auth::user() && Auth::user()->isSudo())
    @include('components.admin_block')
@endif
</body>
</html>
