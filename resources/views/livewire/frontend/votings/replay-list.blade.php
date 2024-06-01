<div>
    @foreach($replays as $replay)
    <div class="row reply">
        <div class="col-md-2 user_info">
            <figure><img src="{{ asset('uploads/images/default/avatar_3.jpg') }}" alt=""></figure>
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
