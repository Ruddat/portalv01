@extends('frontend.layouts.default')
@section('content')
    {{-- seitenabhengig css --}}
    @push('specific-css')
        <link href="{{ asset('frontend/css/detail-page.css') }}" rel="stylesheet">
    @endpush

    <body data-spy="scroll" data-bs-target="#secondary_nav" data-offset="75">

        @include('frontend.includes.header-in-clearfix')
        <div class="hero_in detail_page background-image"
            data-background="url({{ asset('frontend/img/hero_general_2.jpg') }})">
            <div class="wrapper opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                <div class="container">
                    <div class="main_info">
                        <div class="row">
                            <div class="col-xl-4 col-lg-5 col-md-6">
                                <div class="head">
                                    <img src="{{ $restaurant->logo_url }}" alt="Restaurant Logo"
                                        style="max-width: 100px; border-radius: 10px;">

                                    <div class="neon-sign">
                                        <span class="open-text">Open</span>
                                    </div>

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
                                                <div>No reviews yet</div>
                                            @endif
                                            <em>{{ $numberOfRatings }} Reviews</em>
                                        </span><strong>{{ number_format($overallRating, 1) }}</strong></div>
                                </div>
                                <h1>{{ $restaurant->title }}</h1>
                                {{ $restaurant->street }} - {{ $restaurant->city }}, {{ $restaurant->zip }} - <a
                                    href="https://www.google.com/maps/dir/{{ $restaurant->lat }},{{ $restaurant->lng }}/{{ urlencode($restaurant->title) }}"
                                    target="_blank">Get directions to {{ $restaurant->title }}</a>


                            </div>


                            <div class="col-xl-8 col-lg-7 col-md-6 position-relative">
                                <div class="buttons clearfix">
                                    <span class="magnific-gallery">
                                        <a href="{{ asset('frontend/img/detail_1.jpg') }}" class="btn_hero"
                                            title="Photo title" data-effect="mfp-zoom-in"><i class="icon_image"></i>View
                                            photos</a>
                                        <a href="{{ asset('frontend/img/detail_2.jpg') }}" title="Photo title"
                                            data-effect="mfp-zoom-in"></a>
                                        <a href="{{ asset('frontend/img/detail_3.jpg') }}" title="Photo title"
                                            data-effect="mfp-zoom-in"></a>
                                    </span>
                                    <a href="#0" class="btn_hero wishlist"><i class="icon_heart"></i>Wishlist</a>
                                    <a href="#0" class="btn_hero wishlist"><i class="icon_info"></i>Info</a>
                                </div>
                            </div>
                        </div>
                        <!-- /row -->
                    </div>
                    <!-- /main_info -->
                </div>
            </div>
        </div>
        <!--/hero_in-->

        <nav class="secondary_nav sticky_horizontal">
            <div class="container">
                <ul id="secondary_nav">
                    @foreach ($categories as $category)
                        <li><a href="#section-{{ $category->id }}">{{ $category->category_name }}</a></li>
                    @endforeach
                    <li><a href="#section-20"><i class="icon_chat_alt"></i>Reviews</a></li>
                </ul>
            </div>
            <span></span>
        </nav>
        <!-- /secondary_nav -->

        <div class="bg_gray">
            <div class="container margin_detail">
                <div class="row">
                    <div class="col-lg-8 list_menu">

                        <livewire:frontend.product.index :restaurant="$restaurant" :categories="$categories" :sizesWithPrices="$sizesWithPrices"
                            :productsByCategory="$productsByCategory" />

                    </div>
                    <!-- /col -->

                    <div class="col-lg-4" id="sidebar_fixed">
                        <div class="box_order mobile_fixed">
                            <div class="head">
                                <h3>{{ app(\App\Services\TranslationService::class)->trans('Order Summary', app()->getLocale()) }}
                                </h3>
                                <a href="#0" class="close_panel_mobile"><i class="icon_close"></i></a>

                            </div>
                            <!-- /head -->
                            <div class="main">
                                <livewire:frontend.card.cart-component />

                                <div class="row opt_order">
                                    <div class="col-6">
                                        <label
                                            class="container_radio">{{ app(\App\Services\TranslationService::class)->trans('Delivery', app()->getLocale()) }}
                                            <input type="radio" value="option1" name="opt_order" checked>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="col-6">
                                        <label
                                            class="container_radio">{{ app(\App\Services\TranslationService::class)->trans('Selbstabholen', app()->getLocale()) }}
                                            <input type="radio" value="option1" name="opt_order">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>

                                </div>
                                <div class="dropdown day">
                                    <a href="#" data-bs-toggle="dropdown">Day <span id="selected_day"></span></a>
                                    <div class="dropdown-menu">
                                        <div class="dropdown-menu-content">
                                            <h4>Which day delivered?</h4>
                                            <div class="radio_select chose_day">
                                                <ul>
                                                    <li>
                                                        <input type="radio" id="day_1" name="day" value="Today">
                                                        <label for="day_1">Today<em>-40%</em></label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="day_2" name="day"
                                                            value="Tomorrow">
                                                        <label for="day_2">Tomorrow<em>-40%</em></label>
                                                    </li>
                                                </ul>
                                            </div>
                                            <!-- /people_select -->
                                        </div>
                                    </div>
                                </div>
                                <!-- /dropdown -->
                                <div class="dropdown time">
                                    <a href="#" data-bs-toggle="dropdown">Time <span id="selected_time"></span></a>
                                    <div class="dropdown-menu">
                                        <div class="dropdown-menu-content">
                                            <h4>Lunch</h4>
                                            <div class="radio_select add_bottom_15">
                                                <ul>
                                                    <li>
                                                        <input type="radio" id="time_1" name="time"
                                                            value="12.00am">
                                                        <label for="time_1">12.00<em>-40%</em></label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="time_2" name="time"
                                                            value="08.30pm">
                                                        <label for="time_2">12.30<em>-40%</em></label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="time_3" name="time"
                                                            value="09.00pm">
                                                        <label for="time_3">1.00<em>-40%</em></label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="time_4" name="time"
                                                            value="09.30pm">
                                                        <label for="time_4">1.30<em>-40%</em></label>
                                                    </li>
                                                </ul>
                                            </div>


                                            <!-- /time_select -->
                                            <h4>Dinner</h4>
                                            <div class="radio_select">
                                                <ul>
                                                    <li>
                                                        <input type="radio" id="time_5" name="time"
                                                            value="08.00pm">
                                                        <label for="time_1">20.00<em>-40%</em></label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="time_6" name="time"
                                                            value="08.30pm">
                                                        <label for="time_2">20.30<em>-40%</em></label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="time_7" name="time"
                                                            value="09.00pm">
                                                        <label for="time_3">21.00<em>-40%</em></label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="time_8" name="time"
                                                            value="09.30pm">
                                                        <label for="time_4">21.30<em>-40%</em></label>
                                                    </li>
                                                </ul>
                                            </div>
                                            <!-- /time_select -->
                                        </div>
                                    </div>
                                </div>
                                <!-- /dropdown -->
                                <div class="btn_1_mobile">
                                    <a href="{{ route('order', ['restaurantId' => $restaurant->id]) }}"
                                        class="btn_1 gradient full-width mb_5">{{ app(\App\Services\TranslationService::class)->trans('Order Now', app()->getLocale()) }}</a>
                                    <div class="text-center">
                                        <small>{{ app(\App\Services\TranslationService::class)->trans('No money charged on this steps', app()->getLocale()) }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /box_order -->
                        <div class="btn_reserve_fixed"><a href="#0"
                                class="btn_1 gradient full-width">{{ app(\App\Services\TranslationService::class)->trans('View Basket', app()->getLocale()) }}</a>
                        </div>
                    </div>


                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /bg_gray -->

        <div class="container margin_30_20">
            <div class="row">
                <div class="col-lg-8 list_menu">
                    <section id="section-20">
                        <h4>Reviews</h4>
                        <div class="row add_bottom_30 d-flex align-items-center reviews">
                            <div class="col-md-3">
                                <div id="review_summary">
                                    <strong>{{ number_format($overallRating, 1) }}</strong>
                                    <em><em>
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
                                                <div>No reviews yet</div>
                                            @endif
                                        </em></em>
                                    <small>Based on {{ $numberOfRatings }} reviews</small>
                                </div>
                            </div>
                            <div class="col-md-9 reviews_sum_details">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6>Food Quality</h6>
                                        <div class="row">
                                            <div class="col-xl-10 col-lg-9 col-9">
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar"
                                                        style="width: {{ $overallRatingProgress ? $overallRatingProgress->foodQualityTotal * 10 : 0 }}%"
                                                        aria-valuenow="{{ $overallRatingProgress ? $overallRatingProgress->foodQualityTotal * 10 : 0 }}"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="col-xl-2 col-lg-3 col-3">
                                                <strong>{{ $overallRatingProgress ? number_format($overallRatingProgress->foodQualityTotal, 1) : 'N/A' }}</strong>
                                            </div>
                                        </div>
                                        <!-- /row -->
                                        <h6>Service</h6>
                                        <div class="row">
                                            <div class="col-xl-10 col-lg-9 col-9">
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar"
                                                        style="width: {{ $overallRatingProgress ? $overallRatingProgress->serviceTotal * 10 : 0 }}%"
                                                        aria-valuenow="{{ $overallRatingProgress ? $overallRatingProgress->serviceTotal * 10 : 0 }}"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="col-xl-2 col-lg-3 col-3">
                                                <strong>{{ $overallRatingProgress ? number_format($overallRatingProgress->serviceTotal, 1) : 'N/A' }}</strong>
                                            </div>
                                        </div>
                                        <!-- /row -->
                                    </div>
                                    <div class="col-md-6">
                                        <h6>Punctuality</h6>
                                        <div class="row">
                                            <div class="col-xl-10 col-lg-9 col-9">
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar"
                                                        style="width: {{ $overallRatingProgress ? $overallRatingProgress->deliveryTimeTotal * 10 : 0 }}%"
                                                        aria-valuenow="{{ $overallRatingProgress ? $overallRatingProgress->deliveryTimeTotal * 10 : 0 }}"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="col-xl-2 col-lg-3 col-3">
                                                <strong>{{ $overallRatingProgress ? number_format($overallRatingProgress->deliveryTimeTotal, 1) : 'N/A' }}</strong>
                                            </div>
                                        </div>
                                        <!-- /row -->
                                        <h6>Price</h6>
                                        <div class="row">
                                            <div class="col-xl-10 col-lg-9 col-9">
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar"
                                                        style="width: {{ $overallRatingProgress ? $overallRatingProgress->priceTotal * 10 : 0 }}%"
                                                        aria-valuenow="{{ $overallRatingProgress ? $overallRatingProgress->priceTotal * 10 : 0 }}"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="col-xl-2 col-lg-3 col-3">
                                                <strong>{{ $overallRatingProgress ? number_format($overallRatingProgress->priceTotal, 1) : 'N/A' }}</strong>
                                            </div>
                                        </div>
                                        <!-- /row -->
                                    </div>
                                </div>
                                <!-- /row -->
                            </div>


                        </div>
                        <!-- /row -->
                        <div id="reviews">
                            @foreach ($ratings->reverse() as $rating)
                                <div class="review_card">
                                    <div class="row">
                                        <div class="col-md-2 user_info">
                                            <figure><img src="{{ asset('uploads/images/default/avatar_3.jpg') }}"
                                                    alt=""></figure>{{ $rating->gender }}
                                            <h5>{{ $rating->order->surname }}</h5>
                                        </div>

                                        <div class="col-md-10 review_content">
                                            <div class="clearfix add_bottom_15">
                                                <?php
                                                $averageRating = ($rating->food_quality + $rating->service + $rating->price + $rating->punctuality) / 4;
                                                ?>
                                                <span
                                                    class="rating">{{ $averageRating ? number_format($averageRating, 1) : 'N/A' }}<small>/10</small>
                                                    <strong>Rating average</strong></span>
                                                <em>Published {{ $rating->created_at->diffForHumans() }}</em>
                                            </div>
                                            <h4>"{{ $rating->review_title }}"</h4>
                                            <p>{{ $rating->review_content }}</p>
                                            <ul>
                                                <!-- Like Symbol -->
                                                <li>
                                                    <a href="#" class="like-btn"
                                                        data-restaurant-id="{{ $restaurant->id }}"
                                                        data-order-id="{{ $rating->order_id }}">
                                                        <i class="icon_like"></i>
                                                        <span>Useful {{ $rating->likes_count }}</span>
                                                    </a>
                                                </li>

                                                <!-- Dislike Symbol -->
                                                <li>
                                                    <a href="#" class="dislike-btn"
                                                        data-restaurant-id="{{ $restaurant->id }}"
                                                        data-order-id="{{ $rating->order_id }}">
                                                        <i class="icon_dislike"></i>
                                                        <span>Not useful {{ $rating->dislikes_count }}</span>
                                                    </a>
                                                </li>

                                                <!-- Button zum Öffnen des Modals -->
                                                <li>
                                                    <!-- Reply-Link -->
                                                    <a href="#" class="reply-link" data-toggle="collapse"
                                                        data-target="#replyForm{{ $rating->id }}" aria-expanded="false"
                                                        aria-controls="replyForm{{ $rating->id }}">
                                                        <i class="arrow_back"></i>
                                                        <span>Reply</span>
                                                    </a>
                                                </li>
                                            </ul>
                                            <!-- Erfolgsmeldung für jedes Rating -->
                                            <div class="vote-message" style="display: none;">Danke für Ihr Voting!</div>
                                        </div>
                                    </div>

                                    {{-- Reply-Formular --}}


                                    <div class="collapse" id="replyForm{{ $rating->id }}">
                                        <div class="box_general write_review">
                                            <form action="{{ route('vote-restaurant.reply') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="rating_id" value="{{ $rating->id }}">
                                                <h4 class="add_bottom_15">Write a Reply for "{{ $restaurant->title }}"
                                                </h4>
                                                <div class="form-group">
                                                    <label for="reply_title">Title of your Reply</label>
                                                    <input class="form-control" id="reply_title-{{ $rating->id }}"
                                                        name="reply_title" type="text"
                                                        placeholder="If you could say it in one sentence, what would you say?">
                                                    @error('reply_title')
                                                        <span class="error">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="reply_content">Your Reply</label>
                                                    <textarea class="form-control" id="reply_content" name="reply_content" style="height: 180px;"
                                                        placeholder="Write your review to help others learn about this online business"></textarea>
                                                    @error('reply_content')
                                                        <span class="error">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <button type="submit" class="btn_1">Submit Reply</button>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- /row -->
                                    @foreach ($rating->replies->reverse() ?? [] as $reply)
                                        <div class="row reply">
                                            <div class="col-md-2 user_info">
                                                <figure><img src="{{ asset('frontend/img/avatar.jpg') }}" alt="">
                                                </figure>
                                            </div>
                                            <div class="col-md-10">
                                                <div class="review_content">
                                                    <strong>Reply from {{ $reply->reply_author }}</strong>
                                                    <em>Published {{ $reply->created_at->diffForHumans() }}</em>
                                                    <p><br>{{ $reply->reply_title }}<br></p>
                                                    <p>{{ $reply->reply_content }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /reply -->
                                    @endforeach


                                </div>
                            @endforeach

                            <!-- /review_card -->
                            <div class="d-flex">
                                {!! $ratings->links() !!}
                            </div>

                        </div>
                        <!-- /reviews -->
                    </section>
                    <!-- /section -->
                </div>
            </div>
        </div>
        <!-- /container -->


        <!-- Script zum Öffnen des Popups nach dem Laden der Seite -->
        <!-- Einbindung der Livewire-Komponente -->


        <livewire:frontend.storeinfos.store-popup :restaurant="$restaurant" :shopId="$restaurant->id"/>







        @push('specific-scripts')
            <!-- SPECIFIC SCRIPTS -->
            <script src="{{ asset('frontend/js/sticky_sidebar.min.js') }}"></script>
            <script src="{{ asset('frontend/js/sticky-kit.min.js') }}"></script>
            <script src="{{ asset('frontend/js/specific_detail.js') }}"></script>

         <script>
                document.addEventListener('livewire:load', function () {
                    Livewire.on('openPopup', function (status, storeName = null) {
                        $.fancybox.open({
                            src  : '#storePopup',
                            type : 'inline',
                            opts : {
                                afterClose: function () {
                                    Livewire.dispatch('closePopup');
                                }
                            }
                        });
                    });
                });
            </script>


        @endpush
    @endsection
    @if (isset($modalScript) && $modalScript)
        @push('specific-header')
            <link href="{{ asset('frontend/css/modal_popup.css') }}" rel="stylesheet">
        @endpush



        <div class="popup_wrapper">
            <div class="popup_content newsletter_c">
                <span class="popup_close"><i class="icon_close"></i></span>
                <div class="row g-0">
                    <div class="col-md-5 d-none d-md-flex align-items-center justify-content-center">
                        <figure><img src="{{ asset('frontend/img/newsletter_img.jpg') }}" alt=""></figure>
                    </div>
                    <div class="col-md-7">
                        <div class="content">
                            <div class="wrapper">
                                <img src="{{ asset('frontend/img/logo_sticky.svg') }}" width="162" height="35"
                                    alt="">
                                <h3>Entschuldigung, außerhalb des Liefergebiets</h3>
                                <p>Es tut uns leid, aber Ihre Adresse befindet sich außerhalb unseres Liefergebiets.
                                    Bitte überprüfen Sie Ihre Adresse oder kontaktieren Sie uns für weitere
                                    Informationen.</p>
                                <p>Falls Sie weitere Fragen haben, stehen wir Ihnen gerne zur Verfügung.</p>
                                <form action="#">
                                    <div class="form-group">
                                        <input type="email" class="form-control"
                                            placeholder="Enter your email address">
                                    </div>
                                    <button type="submit" class="btn_1 mt-2 mb-4">Subscribe</button>
                                </form>
                                <div class="row opt_order">
                                    <div class="col-6">
                                        <label class="container_radio">Delivery
                                            <input type="radio" value="option1" name="opt_order" checked="">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="col-6">
                                        <label class="container_radio">Take away
                                            <input type="radio" value="option1" name="opt_order">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- row --}}
            </div>
        </div>




        @push('specific-scripts')





            <script>
                (function($) {
                    "use strict";

                    // Popup up
                    setTimeout(function() {
                        $('.popup_wrapper').css('opacity', '1');
                    }, 500); // Entrance delay

                    $('.popup_wrapper');
                    $('.popup_close').click(function() { // Class for the close button
                        $('.popup_wrapper').fadeOut(300); // Hide the CTA div
                    });



                })(window.jQuery);
            </script>


<script>
    $(document).ready(function() {
        // Like-Button klicken
        $('.like-btn').click(function(e) {
            e.preventDefault();
            var btn = $(this);
            var restaurantId = btn.data('restaurant-id');
            var type = 'like';
            vote(restaurantId, type, btn);
        });

        // Dislike-Button klicken
        $('.dislike-btn').click(function(e) {
            e.preventDefault();
            var btn = $(this);
            var restaurantId = btn.data('restaurant-id');
            var type = 'dislike';
            vote(restaurantId, type, btn);
        });

        // Funktion für die Ajax-Anfrage
        function vote(restaurantId, type, btn) {
            $.ajax({
                type: 'POST',
                url: '/vote',
                data: {
                    restaurant_id: restaurantId,
                    order_id: btn.data('order-id'),
                    type: type,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    // Erfolgsmeldung verarbeiten
                    console.log(response);
                    if (response.success) {
                        // Erfolgreich abgestimmt, aktualisieren Sie die Anzeige der Anzahl der Stimmen und den Zustand des Buttons
                        var voteType = type === 'like' ? 'Useful' : 'Not useful';
                        var currentVotesText = btn.find('span').text(); // Textinhalt extrahieren
                        var matches = currentVotesText.match(/\d+/); // Den Wert der Stimmen mit einem regulären Ausdruck extrahieren
                        if (matches && matches.length > 0) {
                            var currentVotes = parseInt(matches[0]); // Extrahierten Wert in eine Ganzzahl konvertieren
                            currentVotes++; // Inkrementieren Sie die Anzahl der Stimmen
                            btn.find('span').text(voteType + ' ' + currentVotes); // Aktualisieren Sie die Anzeige der Anzahl der Stimmen
                            // Zeigen Sie die Erfolgsmeldung an
                            btn.closest('.review_content').find('.vote-message').show();
                        } else {
                            console.error('Unable to extract current votes count');
                        }
                    }
                },
                error: function(xhr, status, error) {
                    // Fehlermeldung verarbeiten
                    console.error(xhr.responseText);
                }
            });
        }
    });
    </script>


<script>
    // JavaScript für das Ein- und Ausblenden des Reply-Formulars
    $(document).ready(function() {
        $('.reply-link').click(function(e) {
            e.preventDefault();
            var targetId = $(this).data('target');
            $(targetId).collapse('toggle');
        });
    });
    </script>



        @endpush
    @endif









        </div>
