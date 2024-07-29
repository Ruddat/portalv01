<div id="comments">
    <h5>@autotranslate('Comments', app()->getLocale())</h5>
    <ul>
        @if($post->comments->where('approved', true)->count())
            @foreach($post->comments->where('approved', true)->whereNull('parent_id') as $comment)
                <li>
                    <div class="avatar">
                        <a href="#"><img src="{{ $comment->avatar }}" alt="Avatar"></a>
                    </div>
                    <div class="comment_right clearfix">
                        <div class="comment_info">
                            @autotranslate('By', app()->getLocale()) <a href="#">{{ $comment->author }}</a>
                            <span>|</span>{{ $comment->created_at->format('d/m/Y') }}
                            <span>|</span>
                            <a href="#" wire:click.prevent="setCommentIdForReply({{ $comment->id }})">Reply</a>
                        </div>
                        @if($comment->moderate)
                            <p>@autotranslate('This comment is under moderation and its content is not displayed.', app()->getLocale())</p>
                        @else
                            <p>{{ $comment->content }}</p>
                        @endif
                    </div>

                    <!-- Display replies for this comment -->
                    @if($comment->replies->where('approved', true)->count())
                        <ul class="replied-to">
                            @foreach($comment->replies->where('approved', true) as $reply)
                                <li>
                                    <div class="avatar">
                                        <a href="#"><img src="{{ $reply->avatar_reply }}" alt="Avatar"></a>
                                    </div>
                                    <div class="comment_right clearfix">
                                        <div class="comment_info">
                                            @autotranslate('By', app()->getLocale()) <a href="#">{{ $reply->author }}</a>
                                            <span>|</span>{{ $reply->created_at->format('d/m/Y') }}
                                        </div>
                                        @if($reply->moderate)
                                            <p>@autotranslate('This reply is under moderation and its content is not displayed.', app()->getLocale())</p>
                                        @else
                                            <p>{{ $reply->content }}</p>
                                        @endif
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    <!-- Display reply form if this comment is being replied to -->
                    @if($comment->id === $commentIdForReply)
                        @livewire('frontend.blog.add-reply-component', ['commentId' => $comment->id], key('reply-' . $comment->id))
                    @endif
                </li>
            @endforeach
        @else
            <li>@autotranslate('No comments yet. Be the first to comment!', app()->getLocale())</li>
        @endif
    </ul>
</div>
