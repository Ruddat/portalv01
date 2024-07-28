@extends('frontend.layouts.default')
@section('content')
    @push('specific-css')
        <link href="{{ asset('frontend/css/blog.css') }}" rel="stylesheet">
        <link href="{{ asset('frontend/css/breadcrumb-styles.css') }}" rel="stylesheet">
    @endpush

    <body>
        @include('frontend.includes.header-in-clearfix')

        <div class="page_header blog element_to_stick">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-7 col-md-7 d-none d-md-block">
                        <h1>Blog and Articles</h1>
                    </div>
                    <div class="col-xl-4 col-lg-5 col-md-5">
                        <div class="search_bar_list">
                            <input type="text" class="form-control" placeholder="Dishes, restaurants or cuisines">
                            <button type="submit"><i class="icon_search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container margin_60_20">
            <div class="row">
                <div class="col-lg-12">
                    {!! \App\Http\Breadcrumbs::generate($breadcrumbs) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-lg-9">
                    <div class="singlepost">
                        <figure>
                            <img alt="" class="img-fluid" src="{{ asset($post->image_large) }}">
                        </figure>
                        <h1>{{ $post->title }}</h1>
                        <div class="postmeta">
                            <ul>
                                <li><a href="{{ url('/category', $post->category->id ?? '') }}"><i class="icon_folder-alt"></i> {{ $post->category->name ?? 'No Category' }}</a></li>
                                <li><i class="icon_calendar"></i> {{ $post->created_at->format('d/m/Y') }}</li>
                                <li><a href="#"><i class="icon_pencil-edit"></i> {{ $post->author->name ?? 'Admin' }}</a></li>
                                <li><a href="#"><i class="icon_comment_alt"></i> ({{ $post->comments_count ?? 0 }}) Comments</a></li>
                            </ul>
                        </div>
                        <div class="post-content">
                            <div class="dropcaps">
                                <p>{!! $post->content !!}</p>
                            </div>
                        </div>
                    </div>

                    <div id="comments">
                        <h5>Comments</h5>
                        <ul>
                            @if($post->comments && $post->comments->count())
                                @foreach($post->comments as $comment)
                                    <li>
                                        <div class="avatar">
                                            <a href="#"><img src="{{ asset('frontend/img/avatar1.jpg') }}" alt=""></a>
                                        </div>
                                        <div class="comment_right clearfix">
                                            <div class="comment_info">
                                                By <a href="#">{{ $comment->author->name ?? 'Anonymous' }}</a>
                                                <span>|</span>{{ $comment->created_at->format('d/m/Y') }}
                                                <span>|</span><a href="#">Reply</a>
                                            </div>
                                            <p>{{ $comment->content }}</p>
                                        </div>
                                        @if($comment->replies && $comment->replies->count())
                                            <ul class="replied-to">
                                                @foreach($comment->replies as $reply)
                                                    <li>
                                                        <div class="avatar">
                                                            <a href="#"><img src="{{ asset('frontend/img/avatar4.jpg') }}" alt=""></a>
                                                        </div>
                                                        <div class="comment_right clearfix">
                                                            <div class="comment_info">
                                                                By <a href="#">{{ $reply->author->name ?? 'Anonymous' }}</a>
                                                                <span>|</span>{{ $reply->created_at->format('d/m/Y') }}
                                                                <span>|</span><a href="#">Reply</a>
                                                            </div>
                                                            <p>{{ $reply->content }}</p>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            @else
                                <li>No comments yet. Be the first to comment!</li>
                            @endif
                        </ul>
                    </div>
                    <hr>
                    <h5>Leave a comment</h5>
                    <div class="row">
                        <div class="col-md-4 col-sm-6">
                            <div class="form-group">
                                <input type="text" name="name" id="name2" class="form-control" placeholder="Name">
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="form-group">
                                <input type="text" name="email" id="email2" class="form-control" placeholder="Email">
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <input type="text" name="website" id="website3" class="form-control" placeholder="Website">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" name="comments" id="comments2" rows="6" placeholder="Comment"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" id="submit2" class="btn_1 add_bottom_15">Submit</button>
                    </div>
                </div>
                <aside class="col-lg-3">
                    <div class="widget">
                        <div class="widget-title first">
                            <h4>Latest Post</h4>
                        </div>
                        <ul class="comments-list">
                            @foreach($latestPosts as $latestPost)
                            <li>
                                <div class="alignleft">
                                    <a href="{{ url('/blog-post', $latestPost->slug ?? $latestPost->id) }}">
                                        <img src="{{ asset($latestPost->image_thumbnail) }}" alt="">
                                    </a>
                                </div>
                                <small>{{ $latestPost->category->name ?? 'No Category' }} - {{ $latestPost->created_at->format('d/m/Y') }}</small>
                                <h3>
                                    <a href="{{ url('/blog-post', $latestPost->slug ?? $latestPost->id) }}" title="">
                                        {{ Str::limit($latestPost->title, 30) }}
                                    </a>
                                </h3>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="widget">
                        <div class="widget-title">
                            <h4>Categories</h4>
                        </div>
                        <ul class="cats">
                            @foreach($categories as $category)
                            <li>
                                <a href="#" wire:click.prevent="updatedCategory({{ $category->id }})">
                                    {{ $category->name }} <span>({{ $category->posts_count }})</span>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="widget">
                        <div class="widget-title">
                            <h4>Popular Tags</h4>
                        </div>
                        <div class="tags">
                            @foreach($allTags as $tag)
                            <a href="#">{{ $tag->name }}</a>
                            @endforeach
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    @endsection
