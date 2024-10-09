
<!-- COMMON SCRIPTS -->
<script src="{{ asset('frontend/js/common_scripts.min.js') }}"></script>
<script src="{{ asset('frontend/js/common_func.js') }}"></script>

@stack('specific-scripts')



<script type="text/javascript">
    var url = "{{ route('change.lang') }}";
    $(".change_lang").change(function() {
        window.location.href = url + "?lang=" + $(this).val();
    });

    // Füge einen passiven Event-Listener für touchstart hinzu
    document.addEventListener('touchstart', function(event) {
        // Dein Code hier, wenn nötig
    }, { passive: true });
</script>



    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        window.addEventListener('swal:modal', event => {
            Swal.fire({
                title: event.detail.title,
                text: event.detail.text,
                icon: event.detail.type,
                showCancelButton: event.detail.cancelButton,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: event.detail.confirmButtonText,
                cancelButtonText: event.detail.cancelButtonText,
            }).then((result) => {
                if (result.isConfirmed) {
                    window.livewire.emit('delete', event.detail.id);
                }
            });
        });

        window.addEventListener('swal:confirm', event => {
            Swal.fire({
                title: event.detail.title,
                text: event.detail.text,
                icon: event.detail.type,
                showCancelButton: event.detail.cancelButton,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: event.detail.confirmButtonText,
                cancelButtonText: event.detail.cancelButtonText,
            }).then((result) => {
                if (result.isConfirmed) {
                    window.livewire.emit('delete', event.detail.id);
                }
            });
        });

        window.addEventListener('swal:toast', event => {
            Swal.fire({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                icon: event.detail.type,
                title: event.detail.title,
            });
        });

        window.addEventListener('toastr:modal', event => {
            toastr[event.detail.type](event.detail.message, event.detail.title);
        });

        window.addEventListener('toastr:confirm', event => {
            toastr[event.detail.type](event.detail.message, event.detail.title);
        });

        window.addEventListener('toastr:toast', event => {
            toastr[event.detail.type](event.detail.message, event.detail.title);
        });

        // JavaScript-Code, um auf das Session-Array zuzugreifen und die Benachrichtigung anzuzeigen
window.addEventListener('DOMContentLoaded', (event) => {
    const toast = {!! json_encode(session('toast')) !!}; // Holen Sie die Benachrichtigung aus der Session

    // Überprüfen Sie, ob eine Benachrichtigung vorhanden ist
    if (toast) {
        // Benachrichtigung anzeigen
        toastr[toast.notify](toast.message);
    }
});

    </script>

<script>
    $(document).ready(function(){
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
    });

    document.addEventListener("livewire:init", () => {
        Livewire.on("toast", (event) => {
            toastr[event.notify](event.message);
        });
    });

</script>

@livewireScripts
