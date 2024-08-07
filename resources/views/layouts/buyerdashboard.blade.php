<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@push('specific-css')
<link href="{{ asset('frontend/css/blog.css') }}" rel="stylesheet">
<link href="{{ asset('frontend/css/buyerdashboard.css') }}" rel="stylesheet">
@endpush

@include('frontend.includes.head')

<body>



    <main>
        {{ $slot }}

        @include('frontend.includes.page-snipped.broker-seller')

    </main>


            <!-- Back to top button -->
            <div id="toTop"></div>

            @include('frontend.includes.footer')
            @include('frontend.includes.modal.sign-in-modal')
            @include('frontend.includes.scripts.scripts-global')


        </body>

        </html>

<script>
    window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove();
    });
}, 4000);
</script>
