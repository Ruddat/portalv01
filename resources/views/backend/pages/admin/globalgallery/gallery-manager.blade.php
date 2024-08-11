@extends('backend.layouts.default-dark')
@section('content')

@push('specific-css')

@endpush



		<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container">
				<div class="row page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Table</a></li>
						<li class="breadcrumb-item"><a href="javascript:void(0)">Bootstrap</a></li>
					</ol>
                </div>
                <!-- row -->

                <div class="row">

                <livewire:backend.shared-tools.gallery-component />




            </div>
        </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->

<style>

.p-20, .wrapper {
    padding: 20px!important;
}

.btn.btn-white {
    color: #30373e;
    background: #fff;
    -webkit-box-shadow: 0 1px #b1b5b8;
    box-shadow: 0 1px #b1b5b8;
}

.gallery-list {
    list-style-type: none;
    margin: -5px -5px 15px;
    padding: 0
}

.gallery-list>li {
    float: left;
    width: 20%;
    padding: 5px
}

.gallery-list>li .image-container {
    border-radius: 5px;
    background: #fff;
    position: relative;
    -webkit-box-shadow: 0 2px 0 rgba(0, 0, 0, .07);
    box-shadow: 0 2px 0 rgba(0, 0, 0, .07)
}

.gallery-list>li .image {
    padding-top: 60%;
    position: relative;
    overflow: hidden;
    border-radius: 5px 5px 0 0
}

.gallery-list>li .image img {
    max-width: 100%;
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    z-index: 1000
}

.gallery-list>li .btn-list {
    position: absolute;
    left: 10px;
    top: 10px;
    right: 10px;
    z-index: 1020
}

.gallery-list>li .info {
    padding: 8px 10px
}

.gallery-list>li .info * {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis
}

.gallery-list>li .info h5 {
    margin: 0;
    font-size: 12px
}

@media (max-width:991px) {
    .gallery-list>li {
        width: 33.33%
    }
}

@media (max-width:480px) {
    .gallery-list>li {
        width: 50%
    }
}



.tag-list {
    list-style-type: none;
    margin: 0;
    padding: 0
}

.tag-list>li {
    float: left;
    margin-right: 5px;
    margin-bottom: 5px
}

.tag-list>li a,
.tag-list>li span {
    border: 2px solid #ebeced;
    border-radius: 40px;
    color: #30373e;
    font-size: 11px;
    padding: 2px 8px;
    display: block
}

.tag-list>li.active a,
.tag-list>li.active span {
    color: #30373e;
    border-color: #30373e
}




</style>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.right-clickable').forEach(element => {
            element.addEventListener('contextmenu', event => {
                event.preventDefault(); // Verhindert das Standard-Kontextmenü

                // Beispiel: Zeige ein benutzerdefiniertes Kontextmenü oder führe eine Aktion aus
                console.log('Rechtsklick auf:', event.target);

                // Optionale Livewire-Aktion aufrufen
                Livewire.dispatch('rightClick', event.target.dataset.id);
            });
        });
    });
</script>

@endsection


