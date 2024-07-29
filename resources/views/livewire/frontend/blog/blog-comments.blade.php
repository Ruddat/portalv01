<div id="comments">
    <h5>Comments</h5>
    <ul>
        @if($comments && $comments->count())
        @foreach($comments->where('approved', true) as $comment)
                <li>
                    <div class="avatar">
                        <a href="#"><img src="{{ asset('frontend/img/avatar1.jpg') }}" alt=""></a>
                    </div>
                    <div class="comment_right clearfix">
                        <div class="comment_info">
                            By <a href="#">{{ $comment->author }}</a>
                            <span>|</span>{{ $comment->created_at->format('d/m/Y') }}
                            <span>|</span>
                            <a href="#" wire:click.prevent="setCommentIdForReply({{ $comment->id }})">Reply</a>
                        </div>
                        <p>{{ $comment->content }}</p>
                    </div>
                    @if($comment->replies && $comment->replies->count())
                        <ul class="replied-to">
                            @foreach($comment->replies->where('approved', true) as $reply)
                                <li>
                                    <div class="avatar">
                                        <a href="#"><img src="{{ asset('frontend/img/avatar4.jpg') }}" alt=""></a>
                                    </div>
                                    <div class="comment_right clearfix">
                                        <div class="comment_info">
                                            By <a href="#">{{ $reply->author }}</a>
                                            <span>|</span>{{ $reply->created_at->format('d/m/Y') }}
                                        </div>
                                        <p>{{ $reply->content }}</p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                    @if($comment->id === $commentIdForReply)
                        @livewire('frontend.blog.add-reply-component', ['commentId' => $comment->id], key('reply-' . $comment->id))
                    @endif
                </li>
            @endforeach
        @else
            <li>No comments yet. Be the first to comment!</li>
        @endif
    </ul>
</div>
