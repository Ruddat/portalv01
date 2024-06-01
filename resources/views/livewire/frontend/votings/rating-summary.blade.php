<div>
    <div class="score"><span>
        @if ($overallRating !== null)
            @php
                $ratingText =
                    $overallRating >= 8.5
                        ? 'Best'
                        : ($overallRating >= 7
                            ? 'Superb'
                            : ($overallRating >= 5
                                ? 'Good'
                                : 'Average'));
            @endphp
            <div>{{ $ratingText }}</div>
        @else
            <div>@autotranslate('No reviews yet', app()->getLocale())</div>
        @endif
        <em>{{ $numberOfRatings }} @autotranslate('Reviews', app()->getLocale())</em>
    </span><strong>{{ number_format($overallRating, 1) }}</strong></div>
</div>
