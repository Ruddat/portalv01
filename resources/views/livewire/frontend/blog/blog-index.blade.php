<div class="container margin_60_20">
    <div class="row">
        <div class="col-lg-9">
            <div class="row">

                @foreach($posts as $post)
                <div class="col-md-6">
                    <article class="blog">
                        <figure>
                            <a href="{{ url('/blog-post', $post->slug ?? $post->id) }}"><img src="{{ asset($post->image_medium) }}" alt="">
                                <div class="preview"><span>@autotranslate('Read more', app()->getLocale())</span></div>
                            </a>
                        </figure>
                        <div class="post_info">
                            <small>{{ $post->category->name ?? 'No Category' }} - {{ $post->created_at->format('d M. Y H:m:s') }}</small>
                            <h2><a href="{{ url('/blog-post', $post->slug ?? $post->id) }}">{{ $post->title }}</a></h2>
                            <p>{{ Str::limit(strip_tags($post->content), 100) }}</p>
                            <ul>
                                <li>
                                    <div class="thumb"><img src="{{ asset('frontend/img/avatar.jpg') }}" alt=""></div> {{ $post->author->name ?? 'Unknown' }}
                                </li>
                                <li><i class="icon_comment_alt"></i>({{ $post->comments_count ?? 0 }})</li>
                            </ul>
                        </div>
                    </article>
                    <!-- /article -->
                </div>
                <!-- /col -->
                @endforeach


            </div>
            <!-- /row -->

            <div class="pagination_fg">
                {{ $posts->links() }}
            </div>

        </div>
        <!-- /col -->

        <aside class="col-lg-3">
            <div class="widget">
                <div class="widget-title first">
                    <h4>@autotranslate('Latest Post', app()->getLocale())</h4>
                </div>
                <ul class="comments-list">
                    @foreach($posts->take(3) as $latestPost)
                    <li>
                        <div class="alignleft">
                            <a href="{{ url('/blog-post', $latestPost->slug ?? $latestPost->id) }}"><img src="{{ asset($latestPost->image_thumbnail) }}" alt=""></a>
                        </div>
                        <small>{{ $latestPost->category->name ?? 'No Category' }} - {{ $latestPost->created_at->format('d M. Y') }}</small>
                        <h3><a href="{{ url('/blog-post', $latestPost->slug ?? $latestPost->id) }}" title="">{{ Str::limit($latestPost->title, 30) }}</a></h3>
                    </li>
                    @endforeach
                </ul>
            </div>
            <!-- /widget -->
            <div class="widget">
                <div class="widget-title">
                    <h4>@autotranslate('Categories', app()->getLocale())</h4>
                </div>
                <ul class="cats">
                    @foreach($categories as $category)
                    <li><a href="#" wire:click.prevent="setCategory({{ $category->id }})">{{ $category->name }} <span>({{ $category->posts_count }})</span></a></li>
                    @endforeach
                </ul>
            </div>
            <!-- /widget -->
            <div class="widget">
                <div class="widget-title">
                    <h4>@autotranslate('Popular Tags', app()->getLocale())</h4>
                </div>
                <div class="tags">
                    @foreach($allTags as $tag)
                    <a href="#" wire:click.prevent="toggleTag({{ $tag->id }})" class="{{ in_array($tag->id, $selectedTags) ? 'active' : '' }}">{{ $tag->name }}</a>
                    @endforeach
                </div>
            </div>
            <!-- /widget -->
        </aside>
        <!-- /aside -->
    </div>
    <!-- /row -->
</div>
