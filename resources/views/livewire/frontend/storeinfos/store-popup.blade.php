<div>
    <!-- Modal Overlay -->
    <div class="modal-backdrop fade @if($isOpen) show @endif" style="@if($isOpen) display: block; @else display: none; @endif"></div>

    <!-- Modal -->
    <div class="modal fade @if($isOpen) show @endif" id="storePopup" tabindex="-1" role="dialog" aria-labelledby="storePopupLabel" aria-hidden="true" style="@if($isOpen) display: block; @else display: none; @endif">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    @if($shopStatus == 'closed')
                        <!-- Modal-Inhalt für dauerhaft geschlossen -->
                        <h2 class="modal-title text-center">geschlossen!!</h2>
                    @elseif($shopStatus == 'off')
                        <!-- Modal-Inhalt für off -->
                        <h2 class="modal-title text-center">ZURZEIT GESCHLOSSEN</h2>
                    @elseif($shopStatus == 'open')
                        <!-- Modal-Inhalt für geöffnet -->
                        <h2 class="modal-title text-center">Einfach liefern lassen</h2>
                    @elseif($shopStatus == 'limited')
                        <!-- Modal-Inhalt für eingerichtet -->
                        <h2 class="modal-title text-center">Shop wird eingerichtet</h2>
                    @elseif($shopStatus == 'on')
                        <!-- Modal-Inhalt für online -->
                        <h2 class="modal-title text-center">{{ $storeName }}</h2>
                    @elseif($shopStatus == 'preorder')
                        <!-- Modal-Inhalt für Vorbestellung -->
                        <h2 class="modal-title text-center">Vorbestellung möglich</h2>
                    @endif
                </div>

                <div class="modal-body">
                    @if($shopStatus == 'closed')
                        <!-- Modal-Inhalt für dauerhaft geschlossen -->
                        <div class="text-center">
                            <img src="{{ $storeLogo }}" alt="{{ $storeName }}" class="img-fluid mb-3" style="max-height: 150px;">
                            <h3>{{ $storeName }}</h3>
                            <p class="text-wrap">Bitte ein anderes Restaurant waehlen!!!</p>
                        </div>

                    @elseif($shopStatus == 'off')
                        <!-- Modal-Inhalt für off -->
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
                        <!-- Modal-Inhalt für eingerichtet -->
                        <div class="text-center">
                            <img src="{{ $storeLogo }}" alt="{{ $storeName }}" class="img-fluid mb-3" style="max-height: 150px;">
                            <h3>{{ $storeName }}</h3>
                            <p class="text-wrap">Der Shop wird gerade eingerichtet. Bitte schaue später noch einmal vorbei.</p>
                        </div>

                    @elseif($shopStatus == 'on' || $shopStatus == 'open')
                        <!-- Modal-Inhalt für online -->
                        <p>Damit dein Essen so schnell wie möglich bei dir ist, brauchen wir bitte noch Adresse.</p>
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
                                <button type="button" class="btn btn-infomodal" wire:click="deliveryPopup">
                                    <i class="icon-food_icon_delivery"></i>Lieferung
                                </button>
                            </div>
                        </form>
                        <div>
                            <h2 class="modal-title text-center">Selbst abholen</h2>
                            <p>Hol' dir deine Bestellung ganz einfach und schnell aus unserer Filiale in <b>{{ $storeCity }} {{ $storeStreet }}</b> ab!</p>
                            <div class="text-center">
                            <button type="button" class="btn btn-infomodal" wire:click="closePopup"><i class="icon-food_icon_shop"></i>Abholung</button>
                            </div>

                        </div>
                    @elseif($shopStatus == 'preorder')
                        <!-- Modal-Inhalt für Vorbestellung -->

                        <div class="modal-body">
                            <p>Der Store hat zurzeit noch geschlossen.
                                Du kannst im aktuellen Store vorbestellen oder einen anderen Store auswählen.</p>
                            <div class="deliveryTimes">
                                <div>
                                    @if(!empty($todayOpeningHours))
                                    <h4>Öffnungszeiten heute</h4>
                                    @foreach($todayOpeningHours as $hour)
                                        @if($hour['is_open'])
                                            @if(\Carbon\Carbon::hasFormat($hour['open'], 'H:i:s') && \Carbon\Carbon::hasFormat($hour['close'], 'H:i:s'))
                                                <div class="opening-hours-item">
                                                    {{ \Carbon\Carbon::createFromFormat('H:i:s', $hour['open'])->format('H:i') }} Uhr - {{ \Carbon\Carbon::createFromFormat('H:i:s', $hour['close'])->format('H:i') }} Uhr
                                                </div>
                                            @else
                                                <div class="opening-hours-item">
                                                    Ungültiges Zeitformat
                                                </div>
                                            @endif
                                        @else
                                            <div class="opening-hours-item">
                                                Geschlossen
                                            </div>
                                        @endif
                                    @endforeach
                                @else
                                    <div class="opening-hours-item">
                                        Keine Öffnungszeiten verfügbar
                                    </div>
                                @endif

                                @if(!$isOpen && !empty($openingHoursForWeek))
                                    <h4>Nächste Öffnungszeiten</h4>
                                    @foreach($openingHoursForWeek as $day => $hours)
                                        <div class="opening-hours-day">
                                            <strong>{{ ucfirst($day) }}:</strong>
                                            @foreach($hours as $hour)
                                                @if($hour['is_open'])
                                                    @if(\Carbon\Carbon::hasFormat($hour['open'], 'H:i:s') && \Carbon\Carbon::hasFormat($hour['close'], 'H:i:s'))
                                                        {{ \Carbon\Carbon::createFromFormat('H:i:s', $hour['open'])->format('H:i') }} Uhr - {{ \Carbon\Carbon::createFromFormat('H:i:s', $hour['close'])->format('H:i') }} Uhr
                                                    @else
                                                        Ungültiges Zeitformat
                                                    @endif
                                                @else
                                                    Geschlossen
                                                @endif
                                            @endforeach
                                        </div>
                                    @endforeach
                                @endif

                                @if($shopStatus === 'preorder')
                                <div class="preorder-notice">
                                    @if(!empty($todayOpeningHours) && isset($todayOpeningHours[0]['open']) && !empty($todayOpeningHours[0]['open']) && $todayOpeningHours[0]['open'] !== 'geschlossen')
                                        @php
                                            try {
                                                $firstOpenHour = \Carbon\Carbon::createFromFormat('H:i:s', $todayOpeningHours[0]['open'])->format('H:i');
                                            } catch (\Exception $e) {
                                                $firstOpenHour = null;
                                            }
                                        @endphp
                                        @if($firstOpenHour)
                                            Wir öffnen heute um {{ $firstOpenHour }} Uhr
                                        @else
                                            Die Öffnungszeit konnte nicht geladen werden.
                                        @endif
                                    @elseif(!empty($nextOpenDay) && !empty($nextOpenTime) && isset($nextOpenTime['open']) && !empty($nextOpenTime['open']) && $nextOpenTime['open'] !== 'geschlossen')
                                        @php
                                            try {
                                                $nextOpenDayName = ucfirst(\Carbon\Carbon::parse($nextOpenDay)->locale('de')->dayName);
                                                $nextOpenHour = \Carbon\Carbon::createFromFormat('H:i:s', $nextOpenTime['open'])->format('H:i');
                                            } catch (\Exception $e) {
                                                $nextOpenDayName = null;
                                                $nextOpenHour = null;
                                            }
                                        @endphp
                                        @if($nextOpenDayName && $nextOpenHour)
                                            Wir öffnen {{ \Carbon\Carbon::parse($nextOpenDay)->isTomorrow() ? 'morgen' : $nextOpenDayName }} um {{ $nextOpenHour }} Uhr
                                        @else
                                            Die nächste Öffnungszeit konnte nicht geladen werden.
                                        @endif
                                    @endif
                                </div>
                            @endif





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
                        <button type="button" class="btn btn-infomodal" wire:click="closePopup">Stöbern</button>
                        <button type="button" class="btn btn-infomodal" wire:click="closePopup">Bestellen</button>
                    @elseif($shopStatus == 'limited')
                        <button type="button" class="btn btn-infomodal" wire:click="redirectToSearch">Zurück zur Restaurantauswahl</button>
                    @elseif($shopStatus == 'on')
                        <button type="button" class="btn btn-infomodal" wire:click="closePopup"><i class="icon-food_icon_shop"></i>Ich möchte nur stöbern</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>



