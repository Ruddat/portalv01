<div>
    @if($currentBanner)
    <div class="promo d-flex flex-column align-items-center justify-content-center text-center" style="background: {{ $currentBanner->banner_color }} url(../frontend/img/pattern.svg) center center repeat; padding: 20px;">
        <h3 class="mb-3">{{ $currentBanner->title }}</h3>
        <p class="mb-3">{{ $currentBanner->description }}</p>
        <i class="{{ $currentBanner->icon }} fa-3x mb-3"></i>
        @if($currentBanner->coupon_code)
        <p class="mb-0">Coupon Code: <strong>{{ $currentBanner->coupon_code }}</strong></p>
        @endif
    </div>
    @endif
</div>
