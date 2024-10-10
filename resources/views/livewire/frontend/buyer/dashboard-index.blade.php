

<div>
    <main>
        @include('frontend.includes.header-in-clearfix')

        @include('layouts.partials.dashboard-header', ['client' => $client])
        <!-- Weitere Inhalte hier -->

        <!-- /page_header -->

        <div class="container margin_60_20">
            <div class="row">
                <div class="col-lg-9">
                    <div class="row">



                        <div class="col-md-12  mb-4">
                            <div class="welcome-message">
                                <h1 class="greeting">Hallo, {{ $client->name }}!</h1>
                                <p class="welcome-text">
                                    Willkommen zurück bei Appetit! Wir freuen uns, Sie wiederzusehen. Vergessen Sie nicht, Ihre <span class="highlight">StampCards</span> zu überprüfen und Ihre <span class="highlight">Coupons</span> einzulösen, um großartige Rabatte zu erhalten. Schauen Sie sich auch Ihre <span class="highlight">Rechnungen</span> an, um den Überblick über Ihre Bestellungen zu behalten.
                                    <br><br>
                                    Wenn Sie Fragen haben, zögern Sie nicht, uns zu kontaktieren. Viel Spaß beim Stöbern und guten Appetit!
                                </p>
                                <div class="thumb_dashboard">
                                    @if ($client->avatar)
                                        <img src="{{ $client->avatar }}" alt="Avatar" class="avatar_dashboard">
                                    @else
                                        <img src="default-avatar.png" alt="Default Avatar" class="avatar_dashboard">
                                    @endif
                                </div>
                            </div>
                            <!-- /article -->



                        </div>
                        <!-- /col -->


                        <div class="row">
                            <div class="col-12"><h2 class="title_small">Restaurants in Ihrer Nähe</h2></div>
                            <!-- /col -->
                            @foreach ($restaurants as $restaurant)
                            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                <div class="strip">
                                    <figure>
                                        <img src="{{ asset('frontend/img/location_1.jpg') }}"
                                            alt="{{ $restaurant->title }} - {{ $restaurant->street }}">
                                        <a href="{{ localized_route('restaurant.index', ['slug' => $restaurant->shop_slug ?? $restaurant->id]) }}" class="strip_info">
                                            <small>Burghers</small>
                                            <div style="display: flex; align-items: center;">
                                                <img src="{{ $restaurant->logo_url }}" alt="Restaurant Logo"
                                                    style="max-width: 89px; max-height: 89px; margin-right: 10px; border-radius: 10px;">
                                                <div class="item_title">
                                                    <h3>{{ $restaurant->title }}</h3>
                                                    <small>{{ $restaurant->street }}</small>
                                                </div>
                                            </div>
                                        </a>
                                    </figure>
                                    <ul>
                                        <li>
                                            <span class="take {{ $restaurant->no_abholung ? 'yes' : 'no' }}"
                                                title="Takeaway">@autotranslate('Pick up', app()->getLocale())</span>
                                            <span class="deliv {{ $restaurant->no_lieferung ? 'yes' : 'no' }}"
                                                title="Delivery">@autotranslate('Delivery', app()->getLocale())</span>
                                            <strong class="icon-food_icon_shop fs2">
                                                {{ number_format($restaurant->distance, 2) }} km</strong>
                                        </li>
                                        <li>
                                            @if ($restaurant->voting_average !== null)
                                                <div class="score" title="Bewertung durchschnitt">
                                                    <strong>{{ number_format($restaurant->voting_average, 1) }}</strong>
                                                </div>
                                            @else
                                            @endif
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            @endforeach

                            <!-- /strip grid -->

                        </div>
                        <div class="d-flex justify-content-center">
                            {{ $restaurants->onEachSide(1)->links() }}
                        </div>







                    </div>
                    <!-- /row -->
                </div>
                <!-- /col -->

                @include('layouts.partials.dashboard-links', ['client' => $client])

            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </main>




<script>
    document.addEventListener('livewire:load', function () {
        Livewire.hook('element.updated', (el, component) => {
            if (el.closest('.pagination')) {
                window.scrollTo({
                    top: document.querySelector('.container').offsetTop,
                    behavior: 'smooth'
                });
            }
        });
    });



</script>



</div>
