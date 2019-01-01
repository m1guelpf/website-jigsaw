@extends('_layouts.ghost')

@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ mix('css/prism.css', 'assets/build') }}" />
@endpush

@push('meta')
    <meta property="og:type" content="article" />
    <meta property="og:title" content="{{ $page->og['title'] ?? $page->title }}" />
    <meta property="og:url" content="{{ $page->getUrl() }}"/>
    <meta property="og:description" content="{{ $page->og['description'] ?? $page->description }}" />
    <meta property="og:image" content="{{ $page->og['image'] ?? $page->cover_image }}" />
@endpush

@push('head', base64_decode($page->inject['head']))

@section('body')
<article>
    <div class="section-featured {{ $page->cover_image != null ? 'is-featured-image' : 'no-featured-image' }}">
    @if($page->cover_image != null)
        <div class="featured-image" style="background-image: url({{ $page->cover_image }})"></div>
    @endif
        <div class="featured-wrap flex">
            <div class="featured-content">
                <div class="tags-wrap">
                    @if($page->featured)
                        <span class="featured-label global-tag">@include('_icons.star') <span>Featured</span></span>
                    @endif
                    @foreach(collect($page->tags)->where('internal', false)->toArray() as $tag)
                        <a class="post-tag global-tag" href="{{ $page->getBaseUrl().'/tag/'.$tag['slug'] }}">{{ $tag['name'] }}</a>
                    @endforeach
                </div>
                <h1 class="white">{{ $page->title }}</h1>
                <div class="item-meta white">
                    <time datetime="{{ $page->getDate()->format('YYYY-MM-DD') }}">{{ $page->getDate()->diffForHumans() }}</time>
                </div>
            </div>
        </div>
    </div>
    <div class="section-post wrap">
        <div class="post-wrap {{ $page->cover_image != null ? '':'no-image' }}">
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
    <a href="{{ $next->getUrl() }}" class="next-post post @foreach($next->tags as $tag) tag-{{ $tag['slug'] }}@endforeach tag-hash-large {{ $next->featured ? 'featured':'' }} {{ $next->cover_image != null ? 'is-image':'' }}">
        @if($next->cover_image != null)
            <div class="prev-next-image" style="background-image: url({{ $next->cover_image }})"></div>
        @endif
        <section class="prev-next-title">
            <h5>Newer Post</h5>
            <h3>{{ $next->title }}</h3>
        </section>
    </a>
    @endif
    @if ($previous = $page->getNext())
        <a href="{{ $previous->getUrl() }}" class="next-post post @foreach($previous->tags as $tag) tag-{{ $tag['slug'] }}@endforeach tag-hash-large {{ $previous->featured ? 'featured':'' }} {{ $previous->cover_image != null ? 'is-image':'' }}">
            @if($previous->cover_image != null)
                <div class="prev-next-image" style="background-image: url({{ $previous->cover_image }})"></div>
            @endif
            <section class="prev-next-title">
                <h5>Older Post</h5>
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
    <script src="{{ mix('js/post.js', 'assets/build') }}"></script>
    <script src="https://unpkg.com/commentbox.io/dist/commentBox.min.js"></script>
    <script>commentBox('5675594515742720-proj');</script>
@endpush
@push('footer', base64_decode($page->inject['footer']))