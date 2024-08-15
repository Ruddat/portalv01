<div>
    @foreach($replays as $replay)
        <div class="row reply">
            <div class="col-md-2 user_info">
                @php
                    $reviewerName = $replay->reply_author;
                    $reviewerAvatar = $replay->avatar ?? 'uploads/images/default/avatar_3.jpg';
                @endphp
                <figure><img src="{{ asset($reviewerAvatar) }}" alt="User avatar"></figure>
                <h5>{{ $reviewerName }}</h5>
            </div>
            <div class="col-md-10">
                <div class="review_content">
                    <strong>Reply from {{ $replay->reply_author }}</strong>
                    <em>Published {{ $replay->created_at->diffForHumans() }}</em>
                    <p>{{ $replay->reply_content }}</p>
                </div>
            </div>
        </div>
    @endforeach
    {{ $replays->links() }}
</div>
