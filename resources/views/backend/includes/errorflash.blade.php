@if (Session::get('success'))
<div id="success-alert" class="alert alert-success solid alert-dismissible fade show">
    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
    <strong>Success!</strong> {!! Session::get('success') !!}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
        <span>
            <i class="fa-solid fa-xmark"></i>
        </span>
    </button>
</div>
@endif
@if (Session::get('fail'))
<div id="success-alert" class="alert alert-danger solid alert-dismissible fade show">
    <svg viewBox="0 0 24 24" width="24 " height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
    <strong>Fail!</strong> {!! Session::get('fail') !!}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
        <span>
            <i class="fa-solid fa-xmark"></i>
        </span>
    </button>
</div>
@endif
@if (Session::get('info'))
<div id="success-alert" class="alert alert-warning solid alert-dismissible fade show">
    <svg viewBox="0 0 24 24" width="24 " height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
    <strong>Info!</strong> {!! Session::get('info') !!}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
        <span>
            <i class="fa-solid fa-xmark"></i>
        </span>
    </button>
</div>
@endif

@push('specific-scripts')
<script>
    // Nach 5 Sekunden die Erfolgsmeldung ausblenden
    setTimeout(function() {
        var successAlert = document.getElementById('success-alert');
        if (successAlert) {
            successAlert.classList.remove('show');
        }
    }, 5000);
</script>
@endpush
