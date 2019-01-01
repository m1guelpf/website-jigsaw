<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $page->title ?? $page->siteName }}</title>
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans:400,400i,700,700i&amp;subset=latin-ext" rel="stylesheet">
    <style>{{ inline(mix('css/screen.css', 'assets/build')) }}</style>
    @stack('styles')

    <meta name="description" content="{!! $page->meta['description'] ?? $page->siteDescription !!}">
    <link rel="canonical" href="{{ $page->getUrl() }}" />
    <meta name="referrer" content="no-referrer-when-downgrade" />
    
    @stack('meta')

    <link rel="home" href="{{ $page->baseUrl }}">
    <link href="/feed.rss" type="application/atom+xml" rel="alternate" title="{{ $page->siteName }} Feed">

    @if ($page->production)
            <!-- Insert analytics code here -->
    @endif

    @stack('head')
</head>

<body class="@yield('body-class') post-template @isset($page->tags) @foreach($page->tags as $tag) tag-{{ $tag['slug'] }}@endforeach @endisset">
    @if ($page->production)
        <div id="codefund" style="position:fixed;z-index:999;"></div>
    @endif
    <div class="global-wrap">
        <div class="section-content-wrap">
            <div class="section-header wrap">
                <header class="header-wrap flex">
                    <div class="header-logo">
                        <h1><a href="{{ $page->baseUrl }}">{{ $page->siteName }}</a></h1>
                    </div>
                    <div class="header-nav">
                        @include('_nav.menu')
                    </div>
                </header>
            </div>
            @yield('body')
        <footer class="section-footer">
            <div class="footer-wrap wrap flex">
                <div class="footer-nav">
                    @include('_nav.menu-footer')
                </div>
                <div class="footer-social-links flex">
                    <a href="https://twitter.com/m1guelpf" target="_blank" rel="noopener">@include('_icons.twitter')</a>
                    <a href="https://feedly.com/i/subscription/feed/{{ $page->baseUrl }}/feed.rss" target="_blank" rel="noopener">@include('_icons.rss')</a>
                </div>
            </div>
            <div class="footer-copyright">
                <span>&copy; {{ date('Y') }} <a href="{{ $page->baseUrl }}">{{ $page->siteName }}</a>.</span> All Rights
                Reserved.
            </div>
        </footer>
    </div>
    <div class="section-search flex">
        <div class="search-close"><svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M15.4285714,12 L24,20.5714286 L20.5714286,24 L12,15.4285714 L3.42857143,24 L3.55271368e-15,20.5714286 L8.57142857,12 L5.32907052e-15,3.42857143 L3.42857143,3.55271368e-15 L12,8.57142857 L20.5714286,3.55271368e-15 L24,3.42857143 L15.4285714,12 Z" /></svg></div>
        <div class="search-image" style="background-image: url({{  $page->cover }})">
        </div>
        <div class="search-wrap">
            <div class="search-content">
                <form class="search-form flex" onsubmit="return false">
                    <input type="text" class="search-input" placeholder="Type your keywords..." autofocus>
                </form>
                <div class="search-meta">
                    <span class="search-info-wrap">Please enter at least 3 characters</span>
                    <span class="search-counter-wrap hide">
                        <span class="counter-results">0</span>
                        Results for your search</span>
                </div>
                <div class="search-results">
                </div>
                <div class="search-suggestion flex">
                    <div class="search-suggestion-tags">
                        <h3>May we suggest a tag?</h3>
                        @foreach($tags as $tag)
                            <a class="post-tag global-tag" href="{{ $page->getBaseUrl().'/tag/'.$tag['slug'] }}">{{ $tag['name'] }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="search-footer">
                <a href="{{ $page->baseUrl }}">{{ $page->siteName }}</a>
                <span>{{ $page->siteDescription }}</span>
            </div>
        </div>
    </div>
    <script>
        var searchPublished = 'Published';
        var searchFeaturedIcon = '<svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M22.9712403,8.05987765 L16.2291373,8.05987765 L12.796794,0.459688839 C12.5516266,-0.153229613 11.4483734,-0.153229613 11.0806223,0.459688839 L7.64827899,8.05987765 L0.906176009,8.05987765 C0.538424938,8.05987765 0.170673866,8.30504503 0.0480901758,8.6727961 C-0.0744935148,9.04054717 0.0480901758,9.40829825 0.293257557,9.65346563 L5.31918887,14.3116459 L3.11268244,22.4021694 C2.99009875,22.7699205 3.11268244,23.1376716 3.48043351,23.382839 C3.72560089,23.6280063 4.21593565,23.6280063 4.46110303,23.5054227 L11.9387082,19.2149935 L19.4163133,23.5054227 C19.538897,23.6280063 19.6614807,23.6280063 19.906648,23.6280063 C20.1518154,23.6280063 20.2743991,23.5054227 20.5195665,23.382839 C20.7647339,23.1376716 20.8873176,22.7699205 20.8873176,22.4021694 L18.6808111,14.3116459 L23.7067424,9.65346563 C23.9519098,9.40829825 24.0744935,9.04054717 23.9519098,8.6727961 C23.7067424,8.30504503 23.3389914,8.05987765 22.9712403,8.05987765 Z"/></svg>';
    </script>
    <script>{{ inline(mix('js/main.js', 'assets/build')) }}</script>
    @if($page->production)
        <script src="https://codefund.app/properties/126/funder.js" async="async"></script>

        <script>
        (function(f, a, t, h, o, m){
            a[h]=a[h]||function(){
                (a[h].q=a[h].q||[]).push(arguments)
            };
            o=f.createElement('script'),
            m=f.getElementsByTagName('script')[0];
            o.async=1; o.src=t; o.id='fathom-script';
            m.parentNode.insertBefore(o,m)
        })(document, window, '//analytics.m1guelpf.me/tracker.js', 'fathom');
        fathom('set', 'siteId', 'LHJWH');
        fathom('trackPageview');
        </script>
    @endif

    @yield('scripts')
    @yield('footer')
</body>

</html>