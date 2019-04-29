@extends('_layouts.ghost')

@push('meta')
<meta name="title" content="Miguel Piedrafita">
<meta name="description" content="{{ $page->siteDescription }}">

<meta property="og:type" content="website">
<meta property="og:url" content="{{ $page->getBaseUrl() }}">
<meta property="og:title" content="Miguel Piedrafita">
<meta property="og:description" content="{{ $page->siteDescription }}">
<meta property="og:image" content="http://m1guelpf.me/20e6eaff9a2e/Image%2525202019-02-05%252520at%2525207.32.17%252520PM.png">

<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="{{ $page->getBaseUrl() }}">
<meta property="twitter:title" content="Miguel Piedrafita">
<meta property="twitter:description" content="{{ $page->siteDescription }}">
<meta property="twitter:image" content="http://m1guelpf.me/20e6eaff9a2e/Image%2525202019-02-05%252520at%2525207.32.17%252520PM.png">
@endpush

@section('body')
            <div class="section-featured no-featured-image wrap">
                <div class="featured-wrap flex" style="padding: 0;">
                    <article class="introduction">
                        <h2>👋 Hi! I'm a 17-year-old who loves to <i>make stuff</i>.</h2>
                        <div class="item-meta white">
                            <p>I'm created
                                <a href="https://blogcast.host" target="_blank">Blogcast</a>, a service that generates audio versions of your articles.</p>
                            <p>Before that, I made
                                <a href="https://unmarkdocs.co" target="_blank">UnMarkDocs</a>, a web application that empowers you to build beautiful, collaborative documentation using super-powered Markdown (that was my first "big" project).</p>
                            <p>I've created
                                <a href="https://coderyouth.club" target="_blank">code community for teenagers</a>, and <a href="https://ghuser.io/m1guelpf"
                                    target="_blank">contributed to over 350 open source projects</a> and started many cool projects I unfortunately didn't finish, like Snaptier or Maker Army.</p>
                            <p>You can <a href="https://twitter.com/m1guelpf" target="_blank">follow me on Twitter</a> for updates on what I'm working on, cool tips and lots of interesting retweets, check out my open-source projects on
                                <a href="https://github.com/m1guelpf" target="_blank">GitHub</a>, or read my articles below. And, if you like what I do, please consider <a href="{{ $page->getBaseUrl() }}/patreon">becoming a Patron</a> and helping me achieve my dream :)</p>
                        </div>
                    </article>
                </div>
            </div>
            <div class="section-loop wrap is-featured">
                <div class="items-wrap flex">
                    @foreach ($posts as $post)
                        @include('_components.post_card', ['baseUrl' => $page->getBaseUrl()])
                    @endforeach
                </div>
            </div>
        </div>
@endsection

@push('scripts')
    {{-- <script src="https://intravert.co/serve/8e50cd520c.4.js"></script> --}}
@endpush
