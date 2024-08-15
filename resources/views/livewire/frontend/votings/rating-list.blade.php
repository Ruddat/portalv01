<div>
    <div class="row add_bottom_30 d-flex align-items-center reviews" wire:click="toggleRatings">
        <div class="col-md-3" >
            <div id="review_summary">
                <strong>{{ number_format($overallRating, 1) }}</strong>
                <section id="section-999">
                <em>{{ $numberOfRatings }} @autotranslate('Reviews', app()->getLocale())</em>

                <div class="score" wire:loading.remove>
                    @if ($showRatings)
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
                    @else
                        <div>@autotranslate('Click to view reviews', app()->getLocale())</div>
                    @endif
                </div>


            </section>
            </div>
        </div>
        <div class="col-md-9 reviews_sum_details">
            <div class="row">
                <div class="col-md-6">
                    <h6>Food Quality</h6>
                    <div class="row">
                        <div class="col-xl-10 col-lg-9 col-9">
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: {{ ($foodQuality / 10) * 100 }}%" aria-valuenow="{{ $foodQuality }}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-3"><strong>{{ number_format($foodQuality, 1) }}</strong></div>
                    </div>
                    <!-- /row -->
                    <h6>Service</h6>
                    <div class="row">
                        <div class="col-xl-10 col-lg-9 col-9">
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: {{ ($service / 10) * 100 }}%" aria-valuenow="{{ $service }}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-3"><strong>{{ number_format($service, 1) }}</strong></div>
                    </div>
                    <!-- /row -->
                </div>
                <div class="col-md-6">
                    <h6>Punctuality</h6>
                    <div class="row">
                        <div class="col-xl-10 col-lg-9 col-9">
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: {{ ($punctuality / 10) * 100 }}%" aria-valuenow="{{ $punctuality }}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-3"><strong>{{ number_format($punctuality, 1) }}</strong></div>
                    </div>
                    <!-- /row -->
                    <h6>Price</h6>
                    <div class="row">
                        <div class="col-xl-10 col-lg-9 col-9">
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: {{ ($price / 10) * 100 }}%" aria-valuenow="{{ $price }}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-3"><strong>{{ number_format($price, 1) }}</strong></div>
                    </div>
                    <!-- /row -->
                </div>
            </div>
            <!-- /row -->
        </div>
    </div>

    <!-- Bewertungen werden nur angezeigt, wenn $showRatings true ist -->
    @if ($showRatings)


    <div id="reviews">
        @foreach($ratings as $rating)
        <div class="review_card">
            <div class="row">
                <div class="col-md-2 user_info">
                    @php
                        $client = App\Models\Client::find($rating->user_id);
                        $reviewerName = $client ? $client->username : $rating->guest_name;
                        $reviewerAvatar = $client ? $client->avatar : 'uploads/images/default/avatar_3.jpg';
                    @endphp
                    <figure><img src="{{ asset($reviewerAvatar) }}" alt=""></figure>
                    <h5>{{ $reviewerName }}</h5>
                </div>
                <div class="col-md-10 review_content">
                    <div class="clearfix add_bottom_15">
                        <span class="rating">{{ number_format(($rating->food_quality + $rating->service + $rating->punctuality + $rating->price) / 4, 1) }}<small>/10</small> <strong>Rating average</strong></span>
                        <em>@autotranslate('Published', app()->getLocale()) {{ $rating->created_at->diffForHumans() }}</em>
                    </div>
                    <h4>{{ $rating->review_title }}</h4>
                    <p>{{ $rating->review_content }}</p>
                    <ul>
                        <li><a href="#" wire:click.prevent="like({{ $rating->id }})"><i class="icon_like"></i><span>@autotranslate('Useful', app()->getLocale()) ({{ $rating->likes_count }})</span></a></li>
                        <li><a href="#" wire:click.prevent="dislike({{ $rating->id }})"><i class="icon_dislike"></i><span>@autotranslate('Not useful', app()->getLocale()) ({{ $rating->dislikes_count }})</span></a></li>
                        <li><a href="#" wire:click.prevent="toggleReplyForm({{ $rating->id }})"><i class="arrow_back"></i><span>@autotranslate('Reply', app()->getLocale())</span></a></li>
                        @if(session()->has('error'))
                        <div class="alert alert-warning">
                            {{ session('error') }}
                            <a href="{{ route('login') }}" class="btn btn-primary">Zum Login</a>
                        </div>
                    @endif
                    </ul>
                </div>
            </div>

        <!-- Hier wird das Replay-Formular angezeigt -->
        @if ($showReplyFormForRatingId === $rating->id)
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ app(\App\Services\AutoTranslationService::class)->trans($error, app()->getLocale()) }}</li>
                @endforeach
            </ul>
        </div>
    @endif

            @if($showReplyForm)
                <div class="row">
                    <div class="col-md-12">
                        <form wire:submit.prevent="addReply">
                            <div class="form-group">
                                <label for="reply_author">Your Name:</label>
                                <input type="text" wire:model="replyAuthor" class="form-control" id="reply_author">
                            </div>
                            <div class="form-group">
                                <label for="reply_title">Reply Title:</label>
                                <input type="text" wire:model="replyTitle" class="form-control" id="reply_title" name="reply_title">
                            </div>
                            <div class="form-group">
                                <label for="reply_content">Reply Content:</label>
                                <textarea wire:model="replyContent" class="form-control" id="reply_content"></textarea>
                            </div>
                            <button type="submit" class="btn_1 gradient">Submit Reply</button>
                        </form>
                    </div>
                </div>
            @endif


        @endif



            @livewire('frontend.votings.replay-list', ['votingId' => $rating->id], key($rating->id))
        </div>

        @endforeach

        {{ $ratings->links() }}
    </div>

    @endif

</div>









