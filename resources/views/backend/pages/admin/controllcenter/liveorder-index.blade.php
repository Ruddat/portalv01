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



        @push('specific-scripts')
        <script src="{{ asset('extra-assets\howler\dist\howler.min.js') }}"></script>

        <script>
            document.addEventListener("DOMContentLoaded", () => {
                document.addEventListener('orderCompleted', () => {
                    const audioContext = new AudioContext();
                    const request = new XMLHttpRequest();
                    request.open('GET', '{{ asset('extra-assets/sounds/cash-register.mp3') }}', true);
                    request.responseType = 'arraybuffer';

                    request.onload = function() {
                        audioContext.decodeAudioData(request.response, function(buffer) {
                            const source = audioContext.createBufferSource();
                            source.buffer = buffer;
                            source.connect(audioContext.destination);
                            source.start(0);
                        });
                    }
                    request.send();
                });
            });
        </script>


<script>
    // JavaScript-Code, um den Sound auszulösen
    document.addEventListener("livewire:load", function () {
        Livewire.hook('message.processed', (message, component) => {
            // Überprüfen, ob die Nachricht "orderCompleted" ist
            if (message.updateQueue[0].method === 'orderCompleted') {
                // Auslösen der Wiedergabe des virtuellen Buttons
                document.getElementById('play-sound-btn').click();
            }
        });
    });
</script>


    @endpush




@endsection


