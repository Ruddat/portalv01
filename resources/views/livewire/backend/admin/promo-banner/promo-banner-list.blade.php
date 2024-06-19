<div>
    @if($currentBanner)
    <div class="promo" style="background: {{ $currentBanner->banner_color }} url(../frontend/img/pattern.svg) center center repeat;">
        <h3>{{ $currentBanner->title }}</h3>
        <p>{{ $currentBanner->description }}</p>
        <i class="{{ $currentBanner->icon }}"></i>
        @if($currentBanner->coupon_code)
        <p>Coupon Code: <strong>{{ $currentBanner->coupon_code }}</strong></p>
        @endif
    </div>
    @endif
</div>
