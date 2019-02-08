
@extends('_layouts.ghost')

@push('meta')
    <meta property="og:site_name" content="{{ $page->siteName }}" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{ $page->siteName }}'s Newsletter" />
    <meta property="og:url" content="{{ $page->getUrl() }}" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title" content="{{ $page->siteName }}'s Newsletter" />
    <meta name="twitter:url" content="{{ $page->getUrl() }}" />
    <meta name="twitter:site" content="@@m1guelpf" />
    <link rel="alternate" type="application/rss+xml" title="Nurui" href="{{ $page->getBaseUrl().'/feed.rss' }}" />
@endpush

    <body class="global-hash-violet global-hash-blue global-hash-gray global-hash-large global-hash-red global-hash-yellow global-hash-green global-hash-purple global-hash-orange global-hash-post-orange global-hash-full-image global-hash-post-violet global-hash-post-red global-hash-subscribe-form">
        <div class="section-page-subscribe flex">
            <div class="page-subscribe-image" style="background-image: url({{ $page->cover }})">
            </div>
            <div class="page-subscribe-wrap">
                <div class="page-subscribe-header">
                    <a href="{{ $page->getBaseUrl() }}">Back to Homepage</a>
                </div>
                <div class="page-subscribe-content flex">
                    <div class="subscribe-wrap">
                        <h3>Subscribed!</h3>
                            You've successfully subscribed to my newsletter!
                        <br>
                        <a href="{{ $page->getBaseUrl() }}" class="subscribe-back-button">Back to Homepage</a>
                    </div>
                </div>
                <div class="page-subscribe-footer">
                    <a href="{{ $page->getBaseUrl() }}">{{ $page->siteName }}.</a>
                    <span>{{ $page->siteDescription }}</span>
                </div>
            </div>
        </div>
    </body>
</html>