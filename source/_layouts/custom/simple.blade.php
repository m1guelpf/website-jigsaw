<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{ $page->title ?? $page->siteName }}</title>
        <meta name="HandheldFriendly" content="True">
        <meta name="MobileOptimized" content="320">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="{{ mix('css/simple.css', 'assets/build') }}">

        @stack('head')
    </head>

    <body class="@yield('body-class')">
            <header class="site-header outer no-cover">
                <div class="inner">
                    <a class="site-title" href="{{ $page->getBaseUrl() }}">Miguel Piedrafita</a>
                    <div class="site-header-content">
                        <h1 class="page-title">{{ $page->title }}</h1>
                        <p class="page-description">{{ $page->excerpt }}</p>
                    </div>
                </div>
            </header>

            <main id="site-main" class="site-main outer">
                <div class="inner">
                    @yield('content')
                </div>
            </main>

        @yield('footer')
    </body>  
</html>