<meta property="og:site_name" content="{{ $page->siteName }}" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="{{ $page->og['title'] ?? $page->title }}" />
    <meta property="og:description" content="{!! $page->og['description'] ?? $page->excerpt !!}" />
    <meta property="og:url" content="{{ $page->getUrl() }}" />
    <meta property="og:image" content="{{ str_contains($page->og['image'] ?? $page->cover_image, 'images.unsplash.com') ? $page->og['image'] ?? $page->cover_image:$page->getBaseUrl().$page->og['image'] ?? $page->cover_image }}" />
    <meta property="article:published_time" content="{{ $page->getDate()->format(DATE_ATOM) }}" />
    {{-- <meta property="article:modified_time" content="2018-12-30T22:10:32.000Z" /> --}}
@foreach($page->tags as $tag)
    <meta property="article:tag" content="{{ $tag['name'] }}" />
@endforeach

    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="{{ $page->twitter['title'] ?? $page->title }}" />
    <meta name="twitter:description" content="{{ $page->twitter['description'] ?? $page->excerpt }}" />
    <meta name="twitter:url" content="{{ $page->getUrl() }}" />
    <meta name="twitter:image" content="{{ str_contains($page->twitter['image'] ?? $page->cover_image, 'images.unsplash.com') ? $page->twitter['image'] ?? $page->cover_image:$page->getBaseUrl().$page->twitter['image'] ?? $page->cover_image }}" />
    <meta name="twitter:label1" content="Written by" />
    <meta name="twitter:data1" content="{{ $page->siteName }}" />
    <meta name="twitter:label2" content="Filed under" />
    <meta name="twitter:data2" content="{{ collect($page->tags)->where('internal', false)->implode('name', ', ') }}" />
    <meta name="twitter:site" content="@m1guelpf" />