<!DOCTYPE html>
<html ⚡>

<head>
    <meta charset="utf-8">
    <title>{{ $page->title }}</title>

    <meta name="HandheldFriendly" content="True" />
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
    @include('_components.meta')

    <link rel="canonical" href="{{ $page->getBaseUrl().'/'.$page->slug }}">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Merriweather:300,700,700italic,300italic|Open+Sans:700,600,400"/>
    <style amp-custom>
        html {
            font-family: sans-serif;
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%
        }

        body {
            margin: 0
        }

        article,
        aside,
        details,
        figcaption,
        figure,
        footer,
        header,
        main,
        menu,
        nav,
        section,
        summary {
            display: block
        }

        audio,
        canvas,
        progress,
        video {
            display: inline-block;
            vertical-align: baseline
        }

        audio:not([controls]) {
            display: none;
            height: 0
        }

        [hidden],
        template {
            display: none
        }

        a {
            background-color: transparent
        }

        a:active,
        a:hover {
            outline: 0
        }

        abbr[title] {
            border-bottom: 1px dotted
        }

        b,
        strong {
            font-weight: bold
        }

        dfn {
            font-style: italic
        }

        h1 {
            margin: 0.67em 0;
            font-size: 2em
        }

        mark {
            background: #ff0;
            color: #000
        }

        small {
            font-size: 80%
        }

        sub,
        sup {
            position: relative;
            vertical-align: baseline;
            font-size: 75%;
            line-height: 0
        }

        sup {
            top: -0.5em
        }

        sub {
            bottom: -0.25em
        }

        img {
            border: 0
        }

        amp-img {
            border: 0
        }

        svg:not(:root) {
            overflow: hidden
        }

        figure {
            margin: 1em 40px
        }

        hr {
            box-sizing: content-box;
            height: 0
        }

        pre {
            overflow: auto
        }

        code,
        kbd,
        pre,
        samp {
            font-family: monospace, monospace;
            font-size: 1em
        }

        button,
        input,
        optgroup,
        select,
        textarea {
            margin: 0;
            color: inherit;
            font: inherit
        }

        button {
            overflow: visible
        }

        button,
        select {
            text-transform: none
        }

        button,
        html input[type="button"],
        input[type="reset"],
        input[type="submit"] {
            cursor: pointer;
            -webkit-appearance: button
        }

        button[disabled],
        html input[disabled] {
            cursor: default
        }

        button::-moz-focus-inner,
        input::-moz-focus-inner {
            padding: 0;
            border: 0
        }

        input {
            line-height: normal
        }

        input[type="checkbox"],
        input[type="radio"] {
            box-sizing: border-box;
            padding: 0
        }

        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            height: auto
        }

        input[type="search"] {
            -webkit-appearance: textfield
        }

        input[type="search"]::-webkit-search-cancel-button,
        input[type="search"]::-webkit-search-decoration {
            -webkit-appearance: none
        }

        fieldset {
            margin: 0 2px;
            padding: 0.35em 0.625em 0.75em;
            border: 1px solid #c0c0c0
        }

        legend {
            padding: 0;
            border: 0
        }

        textarea {
            overflow: auto
        }

        optgroup {
            font-weight: bold
        }

        table {
            border-spacing: 0;
            border-collapse: collapse
        }

        td,
        th {
            padding: 0
        }

        html {
            max-height: 100%;
            height: 100%;
            font-size: 62.5%;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0)
        }

        body {
            max-height: 100%;
            height: 100%;
            color: #3a4145;
            background: #f4f8fb;
            letter-spacing: 0.01rem;
            font-family: "Merriweather", serif;
            font-size: 1.8rem;
            line-height: 1.75em;
            text-rendering: geometricPrecision;
            -webkit-font-feature-settings: "kern" 1;
            -moz-font-feature-settings: "kern" 1;
            -o-font-feature-settings: "kern" 1
        }

        ::-moz-selection {
            background: #d6edff
        }

        ::selection {
            background: #d6edff
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin: 0 0 0.3em 0;
            color: #2e2e2e;
            font-family: "Open Sans", sans-serif;
            line-height: 1.15em;
            text-rendering: geometricPrecision;
            -webkit-font-feature-settings: "dlig" 1, "liga" 1, "lnum" 1, "kern" 1;
            -moz-font-feature-settings: "dlig" 1, "liga" 1, "lnum" 1, "kern" 1;
            -o-font-feature-settings: "dlig" 1, "liga" 1, "lnum" 1, "kern" 1
        }

        h1 {
            text-indent: -2px;
            letter-spacing: -1px;
            font-size: 2.6rem
        }

        h2 {
            letter-spacing: 0;
            font-size: 2.4rem
        }

        h3 {
            letter-spacing: -0.6px;
            font-size: 2.1rem
        }

        h4 {
            font-size: 1.9rem
        }

        h5 {
            font-size: 1.8rem
        }

        h6 {
            font-size: 1.8rem
        }

        a {
            color: #4a4a4a
        }

        a:hover {
            color: #111
        }

        p,
        ul,
        ol,
        dl {
            margin: 0 0 2.5rem 0;
            font-size: 1.5rem;
            text-rendering: geometricPrecision;
            -webkit-font-feature-settings: "liga" 1, "onum" 1, "kern" 1;
            -moz-font-feature-settings: "liga" 1, "onum" 1, "kern" 1;
            -o-font-feature-settings: "liga" 1, "onum" 1, "kern" 1
        }

        ol,
        ul {
            padding-left: 2em
        }

        ol ol,
        ul ul,
        ul ol,
        ol ul {
            margin: 0 0 0.4em 0;
            padding-left: 2em
        }

        dl dt {
            float: left;
            clear: left;
            overflow: hidden;
            margin-bottom: 1em;
            width: 180px;
            text-align: right;
            text-overflow: ellipsis;
            white-space: nowrap;
            font-weight: 700
        }

        dl dd {
            margin-bottom: 1em;
            margin-left: 200px
        }

        li {
            margin: 0.4em 0
        }

        li li {
            margin: 0
        }

        hr {
            display: block;
            margin: 1.75em 0;
            padding: 0;
            height: 1px;
            border: 0;
            border-top: #efefef 1px solid
        }

        blockquote {
            box-sizing: border-box;
            margin: 1.75em 0 1.75em 0;
            padding: 0 0 0 1.75em;
            border-left: #4a4a4a 0.4em solid;
            -moz-box-sizing: border-box
        }

        blockquote p {
            margin: 0.8em 0;
            font-style: italic
        }

        blockquote small {
            display: inline-block;
            margin: 0.8em 0 0.8em 1.5em;
            color: #ccc;
            font-size: 0.9em
        }

        blockquote small:before {
            content: "\2014 \00A0"
        }

        blockquote cite {
            font-weight: 700
        }

        blockquote cite a {
            font-weight: normal
        }

        mark {
            background-color: #fdffb6
        }

        code,
        tt {
            padding: 1px 3px;
            border: #e3edf3 1px solid;
            background: #f7fafb;
            border-radius: 2px;
            white-space: pre-wrap;
            font-family: Inconsolata, monospace, sans-serif;
            font-size: 0.85em;
            font-feature-settings: "liga" 0;
            -webkit-font-feature-settings: "liga" 0;
            -moz-font-feature-settings: "liga" 0
        }

        pre {
            overflow: auto;
            box-sizing: border-box;
            margin: 0 0 1.75em 0;
            padding: 10px;
            width: 100%;
            border: #e3edf3 1px solid;
            background: #f7fafb;
            border-radius: 3px;
            white-space: pre;
            font-family: Inconsolata, monospace, sans-serif;
            font-size: 0.9em;
            -moz-box-sizing: border-box
        }

        pre code,
        pre tt {
            padding: 0;
            border: none;
            background: transparent;
            white-space: pre-wrap;
            font-size: inherit
        }

        kbd {
            display: inline-block;
            margin-bottom: 0.4em;
            padding: 1px 8px;
            border: #ccc 1px solid;
            background: #f4f4f4;
            border-radius: 4px;
            box-shadow: 0 1px 0 rgba(0, 0, 0, 0.2), 0 1px 0 0 #fff inset;
            color: #666;
            text-shadow: #fff 0 1px 0;
            font-size: 0.9em;
            font-weight: 700
        }

        table {
            box-sizing: border-box;
            margin: 1.75em 0;
            max-width: 100%;
            width: 100%;
            background-color: transparent;
            -moz-box-sizing: border-box
        }

        table th,
        table td {
            padding: 8px;
            border-top: #efefef 1px solid;
            vertical-align: top;
            text-align: left;
            line-height: 20px
        }

        table th {
            color: #000
        }

        table caption+thead tr:first-child th,
        table caption+thead tr:first-child td,
        table colgroup+thead tr:first-child th,
        table colgroup+thead tr:first-child td,
        table thead:first-child tr:first-child th,
        table thead:first-child tr:first-child td {
            border-top: 0
        }

        table tbody+tbody {
            border-top: #efefef 2px solid
        }

        table table table {
            background-color: #fff
        }

        table tbody>tr:nth-child(odd)>td,
        table tbody>tr:nth-child(odd)>th {
            background-color: #f6f6f6
        }

        table.plain tbody>tr:nth-child(odd)>td,
        table.plain tbody>tr:nth-child(odd)>th {
            background: transparent
        }

        iframe,
        amp-iframe,
        .fluid-width-video-wrapper {
            display: block;
            margin: 1.75em 0
        }

        .fluid-width-video-wrapper iframe,
        .fluid-width-video-wrapper amp-iframe {
            margin: 0
        }

        textarea,
        select,
        input {
            margin: 0 0 5px 0;
            padding: 6px 9px;
            width: 260px;
            outline: 0;
            border: #e7eef2 1px solid;
            background: #fff;
            border-radius: 4px;
            box-shadow: none;
            font-family: "Open Sans", sans-serif;
            font-size: 1.6rem;
            line-height: 1.4em;
            font-weight: 100;
            -webkit-appearance: none
        }

        textarea {
            min-width: 250px;
            min-height: 80px;
            max-width: 340px;
            width: 100%;
            height: auto
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="search"]:focus,
        input[type="tel"]:focus,
        input[type="url"]:focus,
        input[type="password"]:focus,
        input[type="number"]:focus,
        input[type="date"]:focus,
        input[type="month"]:focus,
        input[type="week"]:focus,
        input[type="time"]:focus,
        input[type="datetime"]:focus,
        input[type="datetime-local"]:focus,
        textarea:focus {
            outline: none;
            outline-width: 0;
            border: #bbc7cc 1px solid;
            background: #fff
        }

        select {
            width: 270px;
            height: 30px;
            line-height: 30px
        }

        .clearfix:before,
        .clearfix:after {
            content: " ";
            display: table
        }

        .clearfix:after {
            clear: both
        }

        .clearfix {
            zoom: 1
        }

        .main-header {
            position: relative;
            display: table;
            overflow: hidden;
            box-sizing: border-box;
            width: 100%;
            height: 50px;
            background: #5ba4e5 no-repeat center center;
            background-size: cover;
            text-align: left;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box
        }

        .content {
            background: #fff;
            padding-top: 15px
        }

        .blog-title,
        .content {
            margin: auto;
            max-width: 600px
        }

        .blog-title a {
            display: block;
            padding-right: 16px;
            padding-left: 16px;
            height: 50px;
            color: #fff;
            text-decoration: none;
            font-family: "Open Sans", sans-serif;
            font-size: 16px;
            line-height: 50px;
            font-weight: 600
        }

        .post {
            position: relative;
            margin-top: 0;
            margin-right: 16px;
            margin-left: 16px;
            padding-bottom: 0;
            max-width: 100%;
            border-bottom: #ebf2f6 1px solid;
            word-wrap: break-word;
            font-size: 0.95em;
            line-height: 1.65em
        }

        .post-header {
            margin-bottom: 1rem
        }

        .post-title {
            margin-bottom: 0
        }

        .post-title a {
            text-decoration: none
        }

        .post-meta {
            display: block;
            margin: 3px 0 0 0;
            color: #9eabb3;
            font-family: "Open Sans", sans-serif;
            font-size: 1.3rem;
            line-height: 2.2rem
        }

        .post-meta a {
            color: #9eabb3;
            text-decoration: none
        }

        .post-meta a:hover {
            text-decoration: underline
        }

        .post-meta .author {
            margin: 0;
            font-size: 1.3rem;
            line-height: 1.3em
        }

        .post-date {
            display: inline-block;
            text-transform: uppercase;
            white-space: nowrap;
            font-size: 1.2rem;
            line-height: 1.2em
        }

        .post-image {
            margin: 0;
            padding-top: 3rem;
            padding-bottom: 30px;
            border-top: 1px #E8E8E8 solid
        }

        .post-content amp-img,
        .post-content amp-anim {
            position: relative;
            left: 50%;
            display: block;
            padding: 0;
            min-width: 0;
            max-width: 112%;
            width: calc(100% + 32px);
            height: auto;
            transform: translateX(-50%);
            -webkit-transform: translateX(-50%);
            -ms-transform: translateX(-50%)
        }

        .footnotes {
            font-size: 1.3rem;
            line-height: 1.6em;
            font-style: italic
        }

        .footnotes li {
            margin: 0.6rem 0
        }

        .footnotes p {
            margin: 0
        }

        .footnotes p a:last-child {
            text-decoration: none
        }

        .site-footer {
            position: relative;
            margin: 0 auto 20px auto;
            padding: 1rem 15px;
            max-width: 600px;
            color: rgba(0, 0, 0, 0.5);
            font-family: "Open Sans", sans-serif;
            font-size: 1.1rem;
            line-height: 1.75em
        }

        .site-footer a {
            color: rgba(0, 0, 0, 0.5);
            text-decoration: none;
            font-weight: bold
        }

        .site-footer a:hover {
            border-bottom: #bbc7cc 1px solid
        }

        .copyright {
            display: block;
            float: left;
            width: 45%
        }
    </style>

    <style amp-boilerplate>
        body {
            -webkit-animation: -amp-start 8s steps(1, end) 0s 1 normal both;
            -moz-animation: -amp-start 8s steps(1, end) 0s 1 normal both;
            -ms-animation: -amp-start 8s steps(1, end) 0s 1 normal both;
            animation: -amp-start 8s steps(1, end) 0s 1 normal both
        }

        @-webkit-keyframes -amp-start {
            from {
                visibility: hidden
            }
            to {
                visibility: visible
            }
        }

        @-moz-keyframes -amp-start {
            from {
                visibility: hidden
            }
            to {
                visibility: visible
            }
        }

        @-ms-keyframes -amp-start {
            from {
                visibility: hidden
            }
            to {
                visibility: visible
            }
        }

        @-o-keyframes -amp-start {
            from {
                visibility: hidden
            }
            to {
                visibility: visible
            }
        }

        @keyframes -amp-start {
            from {
                visibility: hidden
            }
            to {
                visibility: visible
            }
        }
    </style>
    <noscript>
        <style amp-boilerplate>
            body {
                -webkit-animation: none;
                -moz-animation: none;
                -ms-animation: none;
                animation: none
            }
        </style>
    </noscript>
    <script async src="https://cdn.ampproject.org/v0.js"></script>
    @foreach($page->amp_scripts as $script)
        {!! $script !!}
    @endforeach

</head>

<body class="amp-template">
    <header class="main-header">
        <nav class="blog-title">
            <a href="{{ $page->getBaseUrl() }}">{{ $page->siteName }}</a>
        </nav>
    </header>

    <main class="content" role="main">
        <article class="post">

            <header class="post-header">
                <h1 class="post-title">{{ $page->title }}</h1>
                <section class="post-meta">
                    <time class="post-date" datetime="{{ $page->getDate()->toDateString() }}">{{ $page->getDate()->toDateString() }}</time>
                </section>
            </header>
            @if($page->cover_image != null)
            <figure class="post-image">
                <amp-img src="{{ $page->cover_image }}" width="600" height="400" layout="responsive"></amp-img>
            </figure>
            @endif
            <section class="post-content">
                @yield('content')
            </section>

        </article>
    </main>
    <footer class="site-footer clearfix">
        <section class="copyright">
            <a href="{{ $page->getBaseUrl() }}">{{ $page->siteName }}</a> &copy; {{ date('Y') }}</section>
    </footer>
</body>

</html>