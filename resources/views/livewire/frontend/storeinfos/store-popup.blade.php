<div>
    <!-- Modal Overlay -->
    <div class="modal-backdrop fade @if($openPopUp) show @endif" style="@if($openPopUp) display: block; @else display: none; @endif"></div>

    <!-- Modal -->
    <div class="modal fade @if($openPopUp) show @endif" id="storePopup" tabindex="-1" role="dialog" aria-labelledby="storePopupLabel" aria-hidden="true" style="@if($openPopUp) display: block; @else display: none; @endif">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    @if($shopStatus == 'closed')
                        <h2 class="modal-title text-center">@autotranslate('closed!!', app()->getLocale())</h2>
                    @elseif($shopStatus == 'off')
                        <h2 class="modal-title text-center">@autotranslate('CURRENTLY CLOSED', app()->getLocale())</h2>
                    @elseif($shopStatus == 'open')
                        <h2 class="modal-title text-center">@autotranslate('Delivery', app()->getLocale())</h2>
                    @elseif($shopStatus == 'limited')
                        <h2 class="modal-title text-center">@autotranslate('Shop wird eingerichtet', app()->getLocale())</h2>
                    @elseif($shopStatus == 'on')
                        <h2 class="modal-title text-center">{{ $storeName }}</h2>
                    @elseif($shopStatus == 'preorder')
                        <h2 class="modal-title text-center">@autotranslate('Pre-order available', app()->getLocale())</h2>
                    @endif
                </div>

                <div class="modal-body">
                    @if($shopStatus == 'closed')
                        <div class="text-center">
                            <img src="{{ $storeLogo }}" alt="{{ $storeName }}" class="img-fluid mb-3" style="max-height: 150px;">
                            <h3>{{ $storeName }}</h3>
                            <p class="text-wrap">@autotranslate('Please choose another restaurant!', app()->getLocale())</p>
                        </div>

                    @elseif($shopStatus == 'off')
                        <div class="text-center">
                            <img src="{{ $storeLogo }}" alt="{{ $storeName }}" class="img-fluid mb-3" style="max-height: 150px;">
                            <h3>{{ $storeName }}</h3>
                            <p class="text-wrap">@autotranslate('The store is currently closed, and online ordering is not available.', app()->getLocale())</p>
                            <h4 class="modal-body">@autotranslate('ÖFFNUNGSZEITEN', app()->getLocale())</h4>
                            <div class="deliveryTimes">
                                <div class="open_left">@autotranslate('Monday - Sunday', app()->getLocale())</div>
                                <div class="open_right">@autotranslate('closed', app()->getLocale())</div>
                                <div class="clearfix"></div>
                            </div>
                        </div>

                    @elseif($shopStatus == 'limited')
                        <div class="text-center">
                            <img src="{{ $storeLogo }}" alt="{{ $storeName }}" class="img-fluid mb-3" style="max-height: 150px;">
                            <h3>{{ $storeName }}</h3>
                            <p class="text-wrap">@autotranslate('This shop is currently being set up. Please check back later.', app()->getLocale())</p>
                        </div>

                    @elseif($shopStatus == 'on' || $shopStatus == 'open')
                        <p>@autotranslate("To get your food to you as quickly as possible, we'll need your address, please.", app()->getLocale())</p>
                        @if ($errorMessage)
                        <div class="alert alert-danger">
                            {{ $errorMessage }}
                        </div>
                        @endif
                        <form>
                            <div class="row">

                                <div class="mb-3 col-md-9">
                                    <input id="street" name="street" type="text" class="form-control @error('street') is-invalid @enderror" placeholder="@autotranslate('Street*', app()->getLocale())" autocomplete="off" spellcheck="false" wire:model="street">
                                    @error('street') <span class="invalid-feedback">{{ app(\App\Services\AutoTranslationService::class)->trans($message, app()->getLocale()) }}</span> @enderror
                                </div>
                                <div class="mb-3 col-md-3">
                                    <input name="housenumber" type="text" class="form-control @error('housenumber') is-invalid @enderror" placeholder="@autotranslate('Nr.*', app()->getLocale())" wire:model="housenumber">
                                    @error('housenumber') <span class="invalid-feedback">{{ app(\App\Services\AutoTranslationService::class)->trans($message, app()->getLocale()) }}</span> @enderror
                                </div>
                                <div class="mb-3 col-md-3">
                                    <input type="text" class="form-control @error('postal_code') is-invalid @enderror" placeholder="@autotranslate('Postal code*', app()->getLocale())" wire:model="postal_code">
                                    @error('postal_code') <span class="invalid-feedback">{{ app(\App\Services\AutoTranslationService::class)->trans($message, app()->getLocale()) }}
                                    </span> @enderror
                                </div>
                                <div class="mb-3 col-md-9">
                                    <input type="text" class="form-control @error('city') is-invalid @enderror" placeholder="@autotranslate('City*', app()->getLocale())" wire:model="city">
                                    @error('city') <span class="invalid-feedback">{{ app(\App\Services\AutoTranslationService::class)->trans($message, app()->getLocale()) }}</span> @enderror
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="button" class="btn btn-infomodal" wire:click="orderDelivery">
                                    <i class="icon-food_icon_delivery"></i>@autotranslate('Delivery', app()->getLocale())
                                </button>
                            </div>
                        </form>
                        <div>
                            <h2 class="modal-title text-center">@autotranslate('Self Pickup', app()->getLocale())</h2>
                            <p>@autotranslate('Get your order easily and quickly from our store in', app()->getLocale())<b> {{ $storeCity }} {{ $storeStreet }}</b>!</p>
                            <div class="text-center">
                            <button type="button" class="btn btn-infomodal" wire:click="orderPickUp"><i class="icon-food_icon_shop"></i>@autotranslate('Pick up', app()->getLocale())</button>
                            </div>
                        </div>
                    @elseif($shopStatus == 'preorder')
                        <div class="modal-body">
                            <p>{{ $storeName }}
                                @autotranslate('is currently closed.
                                You can now pre-order or choose another store.', app()->getLocale())</p>
                            <div class="deliveryTimes">
                                <div>
                                    @if ($todayOpeningHours instanceof \Illuminate\Support\Collection && $todayOpeningHours->isNotEmpty())
                                        @php
                                            $openingHours = $todayOpeningHours->toArray();
                                        @endphp
                                    @elseif (is_array($todayOpeningHours) && !empty($todayOpeningHours))
                                        @php
                                            $openingHours = $todayOpeningHours;
                                        @endphp
                                    @else
                                        @php
                                            $openingHours = [];
                                        @endphp
                                    @endif

                                    @if (!empty($openingHours))
                                        @foreach ($openingHours as $hours)
                                            @if (!is_null($hours['open']) && !is_null($hours['close']))
                                                <div class="opening-hours-item">
                                                    Öffnet: {{ \Carbon\Carbon::createFromFormat('H:i:s', $hours['open'])->format('H:i') }} Uhr
                                                    Schließt: {{ \Carbon\Carbon::createFromFormat('H:i:s', $hours['close'])->format('H:i') }} Uhr
                                                    @if ($hours['is_open'])

                                                        @autotranslate('(Geöffnet)', app()->getLocale())
                                                    @else
                                                        @autotranslate('(Geschlossen)', app()->getLocale())
                                                    @endif
                                                </div>
                                            @else
                                                <div class="opening-hours-item">
                                                    Der Laden ist heute geschlossen.
                                                </div>
                                            @endif
                                        @endforeach
                                    @else
                                        <div class="opening-hours-item">
                                            Keine Öffnungszeiten verfügbar.
                                        </div>
                                    @endif

                                    {{-- Nächste Öffnungszeiten --}}
                                    @if($isOpen && $nextOpenTime)
                                        <h4>@autotranslate('Next opening hours', app()->getLocale())</h4>

                                        @php
                                            list($nextOpenDay, $nextOpenHour) = explode(' ', $nextOpenTime);
                                            $nextOpenHourFormatted = \Carbon\Carbon::createFromFormat('H:i', $nextOpenHour)->format('H:i');
                                            $nextOpenDayCarbon = \Carbon\Carbon::parse($nextOpenDay);
                                            $nextOpenDayName = $nextOpenDayCarbon->locale('de')->dayName;
                                            $isToday = $nextOpenDayCarbon->isToday();
                                            $isTomorrow = $nextOpenDayCarbon->isTomorrow();
                                        @endphp

                                        <div class="opening-hours-item">
                                            @if($isToday)
                                                @autotranslate('We open today at', app()->getLocale()) {{ $nextOpenHourFormatted }}  @autotranslate('Clock', app()->getLocale())
                                            @elseif($isTomorrow)
                                                @autotranslate('We open tomorrow at', app()->getLocale()) {{ $nextOpenHourFormatted }} @autotranslate('Clock', app()->getLocale())
                                            @else
                                                Wir öffnen wieder am {{ $nextOpenDayName }} um {{ $nextOpenHourFormatted }} Uhr
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-infomodal" wire:click="redirectToSearch">@autotranslate('Change store', app()->getLocale())</button>
                            <button type="button" class="btn btn-infomodal" wire:click.prevent="preOrder"><i class="icon-clock_2"></i>@autotranslate('Pre-order', app()->getLocale())</button>
                        </div>
                    @endif
                </div>

                <div class="modal-footer">
                    @if($shopStatus == 'closed' || $shopStatus == 'off')
                        <button type="button" class="btn btn-infomodal" wire:click="redirectToSearch">@autotranslate('Change store', app()->getLocale())</button>
                        <button type="button" class="btn btn-infomodal" onclick="window.location.href='{{ route('seller.register') }}'">@autotranslate('Shop betreiber?', app()->getLocale())</button>                    @elseif($shopStatus == 'open')
                        <button type="button" class="btn btn-infomodal" wire:click="wantToBrowse">@autotranslate('I just want to browse.', app()->getLocale())</button>
                    @elseif($shopStatus == 'limited')
                        <button type="button" class="btn btn-infomodal" wire:click="redirectToSearch">@autotranslate('Back to restaurant selection', app()->getLocale())</button>
                    @elseif($shopStatus == 'on')
                        <button type="button" class="btn btn-infomodal" wire:click="wantToBrowse"><i class="icon-food_icon_shop"></i>@autotranslate('I just want to browse.', app()->getLocale())</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
