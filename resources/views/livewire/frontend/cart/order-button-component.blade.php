<div class="btn_1_mobile">
    @if($canOrder)
        @if($showOrderDetailsButton ?? true)
            <!-- Zeigt den Button an, der zu den Bestelldetails führt -->
            <a href="{{ route('order', ['restaurantId' => $restaurantId]) }}" class="btn_2 pulse_bt plus_icon full-width mb_5">
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



<style>
a.btn_2.plus_icon, .btn_2.plus_icon {
    padding-bottom: 5px;
    padding-right: 10px;
    align-content: center;
}

a.btn_2.full-width, .btn_2.full-width {
    display: block;
    width: 100%;
    text-align: center;
}

    a.btn_2, .btn_2 {
    border: none;
    background-color: #459c13;
    outline: none;
    cursor: pointer;
    display: inline-block;
    text-decoration: none;
    padding: 8px 25px;
    color: #fff;
    font-weight: 500;
    text-align: center;
    font-size: 14px;
    font-size: 0.875rem;
    -moz-transition: all 0.3s ease-in-out;
    -o-transition: all 0.3s ease-in-out;
    -webkit-transition: all 0.3s ease-in-out;
    -ms-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    -ms-border-radius: 3px;
    border-radius: 3px;
    line-height: normal;
}
</style>


</div>
