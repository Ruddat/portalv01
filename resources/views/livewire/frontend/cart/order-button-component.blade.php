<div>
    <div class="btn_1_mobile">
        @if($canOrder)
            <a href="{{ route('order', ['restaurantId' => $restaurantId]) }}"
                class="btn_1 gradient full-width mb_5">
                {{ app(\App\Services\TranslationService::class)->trans('Order Now', app()->getLocale()) }}
            </a>
        @else
            <button class="btn_1 gradient full-width mb_5" disabled>
                {{ $message }}
            </button>
        @endif

        <div class="text-center">
            <small>@autotranslate('No money charged on this steps', app()->getLocale())</small>
        </div>
    </div>
</div>
