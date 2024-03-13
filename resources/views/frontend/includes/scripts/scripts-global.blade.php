
<!-- COMMON SCRIPTS -->
<script src="{{ asset('frontend/js/common_scripts.min.js') }}"></script>
<script src="{{ asset('frontend/js/common_func.js') }}"></script>

@stack('specific-scripts')



<script type="text/javascript">
    var url = "{{ route('change.lang') }}";
    $(".change_lang").change(function() {
        window.location.href = url + "?lang=" + $(this).val();
    });
</script>



@livewireScripts
