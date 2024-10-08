<div class="preorder-section" x-data="{ showDropdown: @entangle('showDropdown') }" @click.away="showDropdown = false">
    <label for="delivery_time">@autotranslate('Lieferzeitpunkt', app()->getLocale())</label>
    <div class="input-container">
        <input id="delivery_time" readonly="readonly" class="input01 error" type="text" name="delivery_time" value="{{ $selectedTime }}" @click="showDropdown = !showDropdown">
        <span class="icon-clock" @click="showDropdown = !showDropdown">
            <!-- Inline SVG -->
            <svg enable-background="new 0 0 32 32" height="32" viewBox="0 0 32 32" width="32" xmlns="http://www.w3.org/2000/svg"><g fill="#828282"><path d="m16 32c8.822 0 16-7.178 16-16s-7.178-16-16-16-16 7.178-16 16 7.178 16 16 16zm0-31c8.271 0 15 6.729 15 15s-6.729 15-15 15-15-6.729-15-15 6.729-15 15-15z"/><path d="m20.061 21.768c.098.098.226.146.354.146s.256-.049.354-.146c.195-.195.195-.512 0-.707l-4.769-4.768v-6.974c0-.276-.224-.5-.5-.5s-.5.224-.5.5v7.181c0 .133.053.26.146.354z"/><circle cx="4" cy="16" r="1"/><circle cx="28" cy="16" r="1"/><circle cx="16" cy="4" r="1"/><circle cx="16" cy="28" r="1"/><circle cx="8" cy="8" r="1"/><circle cx="24" cy="24" r="1"/><circle cx="25" cy="8" r="1"/><circle cx="8" cy="24" r="1"/></g></svg>
        </span>
    </div>
    <div x-show="showDropdown" class="timepicker-dropdown">
        <div class="title">Bitte Uhrzeit festlegen</div>
        <div>
            <span class="asap" wire:click="clearTime">sofort</span>
        </div>

        <div class="menu">
            <span>@autotranslate('Datum:', app()->getLocale())</span>

            <span class="date" :class="{ 'active': @js($selectedDate) === 'heute' }">{{ \Carbon\Carbon::parse($selectedDate)->format('d.m.Y') }}</span>
            <span class="next arrow_triangle-right_alt" wire:click="nextDay"></span>
        </div>
        <div>
            @if($openingHours->isNotEmpty())
                @foreach($openingHours as $hours)
                    @if(!$hours['is_open'] && !empty($hours['holiday_message']))
                        <div class="alert alert-info">
                            {{ $hours['holiday_message'] }}
                        </div>
                    @else
                        <div class="opening-hours">
                            <p>Öffnet um: {{ $hours['open'] }} -- Schließt um: {{ $hours['close'] }} </p>
                        </div>
                    @endif
                @endforeach
            @else
                <p>Keine Öffnungszeiten für das ausgewählte Datum verfügbar.</p>
            @endif
        </div>
        <div class="header">@autotranslate('Bitte Stunde wählen:', app()->getLocale())</div>
        <div class="hours">
            @foreach($openingHours as $hour)
                @if($hour['is_open'])
                    @php
                        $openTime = \Carbon\Carbon::createFromFormat('H:i:s', $hour['open']);
                        $closeTime = \Carbon\Carbon::createFromFormat('H:i:s', $hour['close']);
                        $currentHour = \Carbon\Carbon::now()->hour;
                        $isToday = \Carbon\Carbon::parse($selectedDate)->isToday();
                    @endphp
                    @for($h = $openTime->hour; $h < $closeTime->hour; $h++)
                        @php
                            $isDisabled = $isToday && $h < $currentHour;
                        @endphp
                        <span class="{{ $h == $selectedHour ? 'active' : '' }} {{ $isDisabled ? 'disabled' : '' }}"
                              @if(!$isDisabled) wire:click="selectHour({{ $h }})" @endif>
                              {{ sprintf('%02d', $h) }}
                        </span>
                    @endfor
                @endif
            @endforeach
        </div>

        @if($selectedHour)
            <div class="header minutes_header">Bitte Minute wählen:</div>
            <div class="minutes">
                @foreach([0, 15, 30, 45] as $minute)
                    @php
                        $currentMinute = \Carbon\Carbon::now()->minute;
                        $isDisabled = $isToday && $selectedHour == $currentHour && $minute <= $currentMinute;
                    @endphp
                    <span class="{{ $minute == $selectedMinute ? 'active' : '' }} {{ $isDisabled ? 'disabled' : '' }}"
                          @if(!$isDisabled) wire:click="selectMinute({{ $minute }})" @endif>
                          {{ sprintf('%02d', $minute) }}
                    </span>
                @endforeach
            </div>
        @endif

        <button class="clear-button" wire:click="clearTime">Zurücksetzen</button>
    </div>

</div>
