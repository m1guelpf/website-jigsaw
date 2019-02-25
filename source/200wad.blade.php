@php
    $page->title = "Daily Writing - Miguel Piedrafita";
@endphp

@extends('_layouts.ghost')

@push('meta')
<meta name="title" content="Daily Writing - Miguel Piedrafita">
<meta name="description" content="I'm a 16-year-old who has been writing daily for 63 days.">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="{{ $page->getUrl() }}">
<meta property="og:title" content="Daily Writing - Miguel Piedrafita">
<meta property="og:description" content="I'm a 16-year-old who has been writing daily for 63 days.">
<meta property="og:image" content="http://m1guelpf.me/330a79dae378/Image%2525202019-02-05%252520at%2525207.37.04%252520PM.png">

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="{{ $page->getUrl() }}">
<meta property="twitter:title" content="Daily Writing - Miguel Piedrafita">
<meta property="twitter:description" content="I'm a 16-year-old who has been writing daily for 63 days.">
<meta property="twitter:image" content="http://m1guelpf.me/330a79dae378/Image%2525202019-02-05%252520at%2525207.37.04%252520PM.png">
@endpush

@section('top')
    <div class="intravert-space" id="space-8e50cd520c4"></div>
@endsection

@section('body')
            <div class="section-featured no-featured-image wrap">
                <div class="featured-wrap flex" style="padding: 0;">
                    <article class="introduction">
                        <h2>👋 Hi! I'm a 16-year-old who has been <i>writing daily</i> for {{ $page->written_days }} days.</h2>
                        <div class="item-meta white">
                            <p>You can learn more about me on
                                <a href="{{ $page->getBaseUrl() }}">my website</a>, follow me on
                                <a href="https://twitter.com/m1guelpf" target="_blank">Twitter</a>, or read my daily articles below. And, if you like what I do, please consider <a href="https://miguelpiedrafita.com/patreon">helping me achieve my dream</a> :)</p>
                        </div>
                    </article>
                </div>
            </div>
            <div class="section-loop wrap is-featured">
                <div class="items-wrap flex">
                    @foreach ($daily as $post)
                        {{-- @includeWhen($post->_meta->collection == 'posts', '_components.post_card', ['baseUrl' => $page->getBaseUrl()]) --}}
                        @includeWhen($post->_meta->collection == 'daily', '_components.200wad_card', ['baseUrl' => $page->getBaseUrl()])
                    @endforeach
                </div>
            </div>
        </div>
@endsection

@push('scripts')
    <script defer src="https://intravert.co/serve/8e50cd520c.4.js"></script>
@endpush