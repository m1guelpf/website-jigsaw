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
                        <h3>Subscribe to {{ $page->siteName }}</h3>
                        <form id="newsletterForm" method="POST" target="_blank">
                            <div class="form-group">
                                <input class="subscribe-email" type="email" id="email" autofocus="autofocus" placeholder="Your email address" required/>
                            </div>
                            <button class="" type="submit"><span>Subscribe</span></button>
                        </form>
                    </div>
                </div>
                <div class="page-subscribe-footer">
                    <a href="{{ $page->getBaseUrl() }}">{{ $page->siteName }}.</a>
                    <span>{{ $page->siteDescription }}</span>
                </div>
            </div>
        </div>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <script>
            document.getElementById('newsletterForm').onsubmit = function(e) {
                e.preventDefault()

                axios.post('https://app.mailerlite.com/webforms/submit/d4j8l4?ml-submit=1&ajax=1&guid=baa9f0fc-f6ab-3081-475a-3dca456bfbdf&fields[email]=' + document.getElementById('email').value).then(function(response) {
                    if (response.data.success) {
                        window.location.href = 'https://miguelpiedrafita.com/subscribed';
                    } else {
                        alert('something went wrong. Please try again or DM me on Twitter :)')
                    }
                }).catch(function() {
                        alert('something went wrong. Please try again or DM me on Twitter :)')
                })
            }
        </script>
    </body>
</html>