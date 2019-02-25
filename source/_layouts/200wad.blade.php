@extends('_layouts.ghost')

@section('body-class', 'post-template tag-hash-post-'.$page->accent)

@push('meta')
<link rel="amphtml" href="{{ $page->getUrl().'/amp' }}" />
@endpush

@section('body')
<article>
    <div class="section-featured no-featured-image">
        <div class="featured-wrap flex">
            <div class="featured-content">
                <div class="tags-wrap">
                        <span class="featured-label global-tag">@include('_icons.star') <span>200wad</span></span>
                    @foreach($page->tags as $tag)
                        <a class="post-tag global-tag">{{ str_after($tag, '#') }}</a>
                    @endforeach
                </div>
                <h1 class="white">{!! $page->title !!}</h1>
                <div class="item-meta white">
                    <time datetime="{{ $page->getDate()->format('YYYY-MM-DD') }}">Day #{{ $page->day }}</time>
                    <span style="margin-right:15px">{{ $page->word_count }} words</span>
                    <span class="reading-time"><svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.1907692,24 C4.5625628,24 0,19.4374372 0,13.8092308 C0,8.18102433 4.5625628,3.61846154 10.1907692,3.61846154 C15.8189757,3.61846154 20.3815385,8.18102433 20.3815385,13.8092308 C20.3815385,19.4374372 15.8189757,24 10.1907692,24 Z M10.1907692,22 C14.7144062,22 18.3815385,18.3328677 18.3815385,13.8092308 C18.3815385,9.28559383 14.7144062,5.61846154 10.1907692,5.61846154 C5.6671323,5.61846154 2,9.28559383 2,13.8092308 C2,18.3328677 5.6671323,22 10.1907692,22 Z"
                                id="Oval"></path>
                            <path d="M7.53230769,2.32923077 C6.98002294,2.32923077 6.53230769,1.88151552 6.53230769,1.32923077 C6.53230769,0.776946019 6.98002294,0.329230769 7.53230769,0.329230769 L12.9225711,0.329230769 C13.4748559,0.329230769 13.9225711,0.776946019 13.9225711,1.32923077 C13.9225711,1.88151552 13.4748559,2.32923077 12.9225711,2.32923077 L7.53230769,2.32923077 Z"
                                id="Line-2"></path>
                            <path d="M13.2928932,9.29289322 C13.6834175,8.90236893 14.3165825,8.90236893 14.7071068,9.29289322 C15.0976311,9.68341751 15.0976311,10.3165825 14.7071068,10.7071068 L10.897876,14.5163376 C10.5073517,14.9068618 9.87418674,14.9068618 9.48366245,14.5163376 C9.09313816,14.1258133 9.09313816,13.4926483 9.48366245,13.102124 L13.2928932,9.29289322 Z"
                                id="Line"></path>
                        </svg> {{ $page->reading_time }}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="section-post wrap">
        <div class="post-wrap no-image" style="padding-bottom:60px;">
            <p data-blogcast-show style="display:none;">Too tired to read? Listen to this article instead:</p>
            <p id="blogcast"></p>
            @yield('content')
        </div>
        <div class="post-meta">
            <div class="post-share">
                <a class="twitter" href="https://twitter.com/share?text={{ urlencode($page->title) }}&amp;url={{ $page->getUrl() }}" onclick="window.open(this.href, 'twitter-share', 'width=550,height=235');return false;">@include('_icons.twitter')</a>
                <a class="facebook" href="https://www.facebook.com/sharer/sharer.php?u={{ $page->getUrl() }}" onclick="window.open(this.href, 'facebook-share','width=580,height=296');return false;">@include('_icons.facebook')</a>
                <a class="reddit" href="http://www.reddit.com/submit?url={{ $page->getUrl() }}" onclick="window.open(this.href, 'reddit-share', 'width=490,height=530');return false;">@include('_icons.reddit')</a>
            </div>
        </div>
    </div>
</article>
<aside class="section-prev-next">
    <div class="prev-next-wrap">
    @if ($next = $page->getPrevious())
    <a href="{{ $next->getUrl('web') }}" class="next-post post tag-hash-large tag-hash-{{ $next->accent }}">
        <section class="prev-next-title">
            <h5>Newer 200wad</h5>
            <h3>{{ $next->title }}</h3>
        </section>
    </a>
    @endif
    @if ($previous = $page->getNext())
        <a href="{{ $previous->getUrl('web') }}" class="next-post post tag-hash-large tag-hash-{{ $previous->accent }}">
            <section class="prev-next-title">
                <h5>Older 200wad</h5>
                <h3>{{ $previous->title }}</h3>
            </section>
        </a>
    @endif
    </div>
</aside>
<div class="section-comments">
    <div class="commentbox"></div>
</div>

</div>
@endsection

@push('scripts')
    <script src="https://blogcast.host/embed.js?url={{ $page->getUrl() }}/"></script>
    <script>{{ inline(mix('js/post.js', 'assets/build')) }}</script>
    <script src="https://unpkg.com/commentbox.io/dist/commentBox.min.js"></script>
    <script>commentBox('5675594515742720-proj');</script>
@endpush