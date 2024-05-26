<div>
    <!-- Modal Overlay -->
    <div class="modal-backdrop fade @if($openPopUp) show @endif" style="@if($openPopUp) display: block; @else display: none; @endif"></div>

    <!-- Modal -->
    <div class="modal fade @if($openPopUp) show @endif" id="storePopup" tabindex="-1" role="dialog" aria-labelledby="storePopupLabel" aria-hidden="true" style="@if($openPopUp) display: block; @else display: none; @endif">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    @if($shopStatus == 'closed')
                        <h2 class="modal-title text-center">geschlossen!!</h2>
                    @elseif($shopStatus == 'off')
                        <h2 class="modal-title text-center">ZURZEIT GESCHLOSSEN</h2>
                    @elseif($shopStatus == 'open')
                        <h2 class="modal-title text-center">Einfach liefern lassen</h2>
                    @elseif($shopStatus == 'limited')
                        <h2 class="modal-title text-center">Shop wird eingerichtet</h2>
                    @elseif($shopStatus == 'on')
                        <h2 class="modal-title text-center">{{ $storeName }}</h2>
                    @elseif($shopStatus == 'preorder')
                        <h2 class="modal-title text-center">Vorbestellung möglich</h2>
                    @endif
                </div>

                <div class="modal-body">
                    @if($shopStatus == 'closed')
                        <div class="text-center">
                            <img src="{{ $storeLogo }}" alt="{{ $storeName }}" class="img-fluid mb-3" style="max-height: 150px;">
                            <h3>{{ $storeName }}</h3>
                            <p class="text-wrap">Bitte ein anderes Restaurant waehlen!!!</p>
                        </div>

                    @elseif($shopStatus == 'off')
                        <div class="text-center">
                            <img src="{{ $storeLogo }}" alt="{{ $storeName }}" class="img-fluid mb-3" style="max-height: 150px;">
                            <h3>{{ $storeName }}</h3>
                            <p class="text-wrap">Der Store hat zurzeit geschlossen und es ist keine Online Bestellung möglich.</p>
                            <h4 class="modal-body">ÖFFNUNGSZEITEN</h4>
                            <div class="deliveryTimes">
                                <div class="open_left">Montag - Sonntag</div>
                                <div class="open_right">geschlossen</div>
                                <div class="clearfix"></div>
                            </div>
                        </div>

                    @elseif($shopStatus == 'limited')
                        <div class="text-center">
                            <img src="{{ $storeLogo }}" alt="{{ $storeName }}" class="img-fluid mb-3" style="max-height: 150px;">
                            <h3>{{ $storeName }}</h3>
                            <p class="text-wrap">Der Shop wird gerade eingerichtet. Bitte schaue später noch einmal vorbei.</p>
                        </div>

                    @elseif($shopStatus == 'on' || $shopStatus == 'open')
                        <p>Damit dein Essen so schnell wie möglich bei dir ist, brauchen wir bitte noch die Adresse.</p>
                        <form>
                            <div class="row">
                                <div class="mb-3 col-md-9">
                                    <input id="street" name="street" type="text" class="form-control @error('street') is-invalid @enderror" placeholder="Street*" autocomplete="off" spellcheck="false" wire:model="street">
                                    @error('street') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3 col-md-3">
                                    <input name="housenumber" type="text" class="form-control @error('housenumber') is-invalid @enderror" placeholder="Nr.*" wire:model="housenumber">
                                    @error('housenumber') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3 col-md-3">
                                    <input type="text" class="form-control @error('postcode') is-invalid @enderror" placeholder="Postleitzahl*" wire:model="postcode">
                                    @error('postcode') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3 col-md-9">
                                    <input type="text" class="form-control @error('city') is-invalid @enderror" placeholder="City*" wire:model="city">
                                    @error('city') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="button" class="btn btn-infomodal" wire:click="orderDelivery">
                                    <i class="icon-food_icon_delivery"></i>Lieferung
                                </button>
                            </div>
                        </form>
                        <div>
                            <h2 class="modal-title text-center">Selbst abholen</h2>
                            <p>Hol' dir deine Bestellung ganz einfach und schnell aus unserer Filiale in <b>{{ $storeCity }} {{ $storeStreet }}</b> ab!</p>
                            <div class="text-center">
                            <button type="button" class="btn btn-infomodal" wire:click="orderPickUp"><i class="icon-food_icon_shop"></i>Abholung</button>
                            </div>
                        </div>
                    @elseif($shopStatus == 'preorder')
                        <div class="modal-body">
                            <p>{{ $storeName }} hat zurzeit noch geschlossen.
                                Du kannst jetzt vorbestellen oder einen anderen Store auswählen.</p>
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
                                                <div>
                                                    Öffnet: {{ \Carbon\Carbon::createFromFormat('H:i:s', $hours['open'])->format('H:i') }} Uhr
                                                    Schließt: {{ \Carbon\Carbon::createFromFormat('H:i:s', $hours['close'])->format('H:i') }} Uhr
                                                    @if ($hours['is_open'])
                                                        (Geöffnet)
                                                    @else
                                                        (Geschlossen)
                                                    @endif
                                                </div>
                                            @else
                                                <div>
                                                    Der Laden ist heute geschlossen.
                                                </div>
                                            @endif
                                        @endforeach
                                    @else
                                        <div>
                                            Keine Öffnungszeiten verfügbar.
                                        </div>
                                    @endif

                                    <!-- Nächste Öffnungszeiten -->
                                    @if($isOpen && $nextOpenTime)
                                        <h4>Nächste Öffnungszeiten</h4>
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
                                                Wir öffnen heute um {{ $nextOpenHourFormatted }} Uhr
                                            @elseif($isTomorrow)
                                                Wir öffnen morgen um {{ $nextOpenHourFormatted }} Uhr
                                            @else
                                                Wir öffnen wieder am {{ $nextOpenDayName }} um {{ $nextOpenHourFormatted }} Uhr
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-infomodal" wire:click="redirectToSearch">Store wechseln</button>
                            <button type="button" class="btn btn-infomodal" wire:click.prevent="preOrder"><i class="icon-clock_2"></i>Vorbestellen</button>
                        </div>
                    @endif
                </div>

                <div class="modal-footer">
                    @if($shopStatus == 'closed' || $shopStatus == 'off')
                        <button type="button" class="btn btn-infomodal" wire:click="redirectToSearch">Store wechseln</button>
                    @elseif($shopStatus == 'open')
                        <button type="button" class="btn btn-infomodal" wire:click="wantToBrowse">Ich möchte nur stöbern</button>
                    @elseif($shopStatus == 'limited')
                        <button type="button" class="btn btn-infomodal" wire:click="redirectToSearch">Zurück zur Restaurantauswahl</button>
                    @elseif($shopStatus == 'on')
                        <button type="button" class="btn btn-infomodal" wire:click="wantToBrowse"><i class="icon-food_icon_shop"></i>Ich möchte nur stöbern</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
