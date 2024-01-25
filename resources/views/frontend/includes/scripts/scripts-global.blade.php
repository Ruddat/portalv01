<!-- COMMON SCRIPTS -->
<script src="{{ asset('frontend/js/common_scripts.min.js') }}"></script>
<script src="{{ asset('frontend/js/common_func.js') }}"></script>
<script src="{{ asset('frontend/assets/validate.js') }}"></script>

@stack('specific-scripts')

@livewireScripts

<script type="text/javascript">
    var url = "{{ route('change.lang') }}";
    $(".change_lang").change(function() {
        window.location.href = url + "?lang=" + $(this).val();
    });
</script>
