<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">


@include('frontend.includes.head')


<body>

    @stack('specific-header')



    <main>

        @yield('content')

    </main>


    <!-- Back to top button -->
    <div id="toTop"></div>


    @include('frontend.includes.footer')
    @include('frontend.includes.modal.sign-in-modal')
    @include('frontend.includes.scripts.scripts-global')



</body>

</html>


# Compare this snippet from resources/views/frontend/includes/scripts/scripts.home.blade.php:
