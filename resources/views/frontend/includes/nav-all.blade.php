<nav class="main-menu">
    <div id="header_menu">
        <a href="#0" class="open_close">
            <i class="icon_close"></i><span>{{ app(\App\Services\AutoTranslationService::class)->trans('Menu', app()->getLocale()) }}</span>
        </a>
        <a href="{{ url('/') }}"><img src="{{ asset('frontend/img/logo.svg') }}" width="162" height="35" alt=""></a>
    </div>
    <ul>
        <li><a href="{{ localized_route('blog') }}">{{ app(\App\Services\AutoTranslationService::class)->trans('Blog', app()->getLocale()) }}</a></li>
        <li><a href="{{ localized_route('broker.register') }}">{{ app(\App\Services\AutoTranslationService::class)->trans('Job?', app()->getLocale()) }}</a></li>
        <li><a href="{{ localized_route('seller.register') }}">{{ app(\App\Services\AutoTranslationService::class)->trans('Restaurant anmelden', app()->getLocale()) }}</a></li>
    </ul>
</nav>
