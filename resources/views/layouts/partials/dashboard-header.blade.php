<div>
    <div class="page_header blog element_to_stick">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-7 col-md-7 d-none d-md-block">
                    <h1>Hallo, {{ $client->name }} {{ $client->last_name }}</h1>
                    <div class="thumb_dashboard">
                        @if ($client->avatar)
                            <img src="{{ $client->avatar }}" alt="Avatar" class="avatar_dashboard">
                        @else
                            <img src="default-avatar.png" alt="Default Avatar" class="avatar_dashboard">
                        @endif
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5 col-md-5">
                    <div class="search_bar_list">
                        <input type="text" class="form-control" placeholder="Dishes, restaurants or cuisines">
                        <button type="submit"><i class="icon_search"></i></button>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
    </div>
    <!-- /page_header -->
</div>
