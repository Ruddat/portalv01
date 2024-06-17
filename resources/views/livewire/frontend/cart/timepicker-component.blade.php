<div class="preorder-section" x-data="{ showDropdown: @entangle('showDropdown') }" @click.away="showDropdown = false">
    <label for="preorder-time">Vorbestellungszeit auswählen:</label>
    <input type="text" readonly value="{{ $selectedTime }}" @click="showDropdown = !showDropdown">

    <div x-show="showDropdown" class="timepicker-dropdown">
        <div class="date-navigation">
            <button wire:click="setSelectedDate('heute')" :class="{ 'active': @js($selectedDate) === 'heute' }">heute</button>
            <button wire:click="setSelectedDate('morgen')" :class="{ 'active': @js($selectedDate) === 'morgen' }">morgen</button>
        </div>

        @if(($selectedDate === 'heute' && !$selectedHour) || ($selectedDate === 'morgen' && !$selectedHour))
            <div class="hour-selection">
                <label>Bitte Stunde wählen:</label>
                <div class="hours-grid">
                    @foreach(($selectedDate === 'heute' ? $todayOpeningHours : $tomorrowOpeningHours) as $hour)
                        @if($hour['is_open'])
                            @php
                                $openTime = \Carbon\Carbon::createFromFormat('H:i:s', $hour['open']);
                                $closeTime = \Carbon\Carbon::createFromFormat('H:i:s', $hour['close']);
                                $now = \Carbon\Carbon::now();
                            @endphp
                            @for($h = $openTime->hour; $h < $closeTime->hour; $h++)
                                @if($selectedDate === 'morgen' || $now->lt(\Carbon\Carbon::createFromTime($h, 0, 0)))
                                    <button wire:click="selectHour({{ $h }})">{{ sprintf('%02d', $h) }}</button>
                                @endif
                            @endfor
                        @endif
                    @endforeach
                </div>
            </div>
        @elseif($selectedHour && !$selectedMinute)
            <div class="minute-selection">
                <label>Bitte Minute wählen:</label>
                <div class="minutes-grid">
                    @php
                        $now = \Carbon\Carbon::now();
                        $selectedTime = \Carbon\Carbon::createFromTime($selectedHour, 0, 0);
                    @endphp
                    @foreach([0, 15, 30, 45] as $minute)
                        @if($selectedDate === 'morgen' || ($selectedTime->copy()->addMinutes($minute)->gt($now) && $now->hour === $selectedHour))
                            <button wire:click="selectMinute({{ $minute }})">{{ sprintf('%02d', $minute) }}</button>
                        @elseif($selectedDate === 'heute' && $selectedHour > $now->hour)
                            <button wire:click="selectMinute({{ $minute }})">{{ sprintf('%02d', $minute) }}</button>
                        @endif
                    @endforeach
                </div>
            </div>
        @endif

        @if($selectedHour && $selectedMinute)
            <div class="selected-time">
                <span>Ausgewählte Zeit: {{ sprintf('%02d', $selectedHour) }}:{{ sprintf('%02d', $selectedMinute) }}</span>
            </div>
        @endif

        <button class="clear-button" wire:click="clearTime">Zurücksetzen</button>
    </div>

    <style>
        .preorder-section {
            margin-top: 20px;
        }

        .preorder-section label {
            display: block;
            margin-bottom: 5px;
        }

        .preorder-section input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
        }

        .preorder-section button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: black !important;
            border: none;
            cursor: pointer;
        }

        .preorder-section button:hover {
            background-color: #45a049;
        }

        .timepicker-dropdown {
            border: 1px solid #ccc;
            padding: 10px;
            background: white;
            position: absolute;
            z-index: 1000;
        }

        .date-navigation {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .date-navigation button {
            padding: 5px 10px;
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            cursor: pointer;
        }

        .date-navigation button.active {
            background-color: #4CAF50;
            color: white;
        }

        .hours-grid, .minutes-grid {
            display: flex;
            flex-wrap: wrap;
        }

        .hours-grid button, .minutes-grid button {
            width: 50px !important;
            padding: 5px;
            margin: 5px;
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            cursor: pointer;
        }
    </style>
</div>
