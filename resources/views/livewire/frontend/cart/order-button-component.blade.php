<div class="btn_1_mobile">
    @if($canOrder)
        @if($showOrderDetailsButton ?? true)
            <!-- Zeigt den Button an, der zu den Bestelldetails führt -->
            <a href="{{ route('order', ['restaurantId' => $restaurantId]) }}" class="btn_1 pulse_bt plus_icon full-width mb_5">
                {{ app(\App\Services\TranslationService::class)->trans('Weiter', app()->getLocale()) }}
                <i class="arrow_triangle-right"></i>
            </a>
        @else
            <!-- Zeigt den Button an, der die Bestellung auslöst -->
            <button type="submit" class="btn_1 pulse_bt plus_icon full-width mb_5">
                @autotranslate('Order Now....', app()->getLocale())
                <i class="arrow_triangle-right"></i>
            </button>
        @endif
    @else
        <!-- Zeigt den Button an, wenn die Bestellung nicht möglich ist -->
        <button class="btn_1 gray full-width mb_5" disabled>
            {{ $message }}
        </button>
    @endif

    <div class="text-center">
        <small>@autotranslate('No money charged on this step', app()->getLocale())</small>
    </div>
</div>
