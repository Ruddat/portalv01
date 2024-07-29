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
                        <h1>@autotranslate('Blogdetails and Articles', app()->getLocale())</h1>
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

    @if (session()->has('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif

@if (session()->has('fail'))
    <div class="alert alert-danger">
        {{ session('fail') }}
    </div>
@endif

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
                                <li><a href="#"><i class="icon_comment_alt"></i> ({{ $post->comments_count ?? 0 }}) @autotranslate('Comments', app()->getLocale())</a></li>
                            </ul>
                        </div>
                        <div class="post-content">
                            <div class="dropcaps">
                                <p>{!! $post->content !!}</p>
                            </div>
                        </div>
                    </div>

                    <livewire:frontend.blog.blog-comments :postId="$post->id" />

                    <hr>

                    <h5>@autotranslate('Leave a comment', app()->getLocale())</h5>
                    <livewire:frontend.blog.add-comment :postId="$post->id" />

                </div>
                <aside class="col-lg-3">
                    <div class="widget">
                        <div class="widget-title first">
                            <h4>@autotranslate('Latest Post', app()->getLocale())</h4>
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
                            <h4>@autotranslate('Categories', app()->getLocale())</h4>
                        </div>
                        <ul class="cats">
                            @foreach($categories as $category)
                            <li>
                                <a href="#" wire:click.prevent="setCategory({{ $category->id }})">
                                    {{ $category->name }} <span>({{ $category->posts_count }})</span>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="widget">
                        <div class="widget-title">
                            <h4>@autotranslate('Popular Tags', app()->getLocale())</h4>
                        </div>
                        <div class="tags">
                            @foreach($allTags as $tag)
                            <a href="#" wire:click.prevent="toggleTag({{ $tag->id }})">{{ $tag->name }}</a>
                            @endforeach
                        </div>
                    </div>
                </aside>
            </div>
        </div>








        <style>
            .tags a {
                margin-right: 10px;
                text-decoration: none;
                color: #3498db;
            }
            .tags a.active {
                font-weight: bold;
                color: #e67e22;
            }
        </style>
    @endsection
