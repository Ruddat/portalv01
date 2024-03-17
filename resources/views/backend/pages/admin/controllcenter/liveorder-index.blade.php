@extends('backend.layouts.default-dark')
@section('pageTitle', isset($pageTitle) ? app(\App\Services\TranslationService::class)->trans($pageTitle, app()->getLocale()) : app(\App\Services\TranslationService::class)->trans('Page title here....', app()->getLocale()))

@section('content')

@push('specific-css')

@endpush



		<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->


            <livewire:backend.admin.live-orders.live-orders-list />



        </div>
        <!--**********************************
            Content body end
        ***********************************-->


        @push('scripts')
    <script>
    document.addEventListener('livewire:load', function () {
        Livewire.on('notificationSoundPlayed', function () {
            const audio = new Audio('{{ asset("extra-assets/sounds/cash-register.mp3") }}');
            audio.play();
        });
    });

</script>





        @endpush


@endsection


