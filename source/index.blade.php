@extends('_layouts.ghost')

@section('body')
            <div class="section-featured no-featured-image wrap">
                <div class="featured-wrap flex">
                    <article class="introduction">
                        <h2>👋 Hi! I'm a 16-year-old who loves to <i>make stuff</i>.</h2>
                        <div class="item-meta white">
                            <p>I'm the co-founder of
                                <a href="https://maker.army" target="_blank">Maker Army</a>, a modern platform built to provide makers with financial stability and overall, better the future of digital
                                creativity.</p>
                            <p>I made
                                <a href="https://unmarkdocs.co" target="_blank">UnMarkDocs</a>, a web application that empowers you to build beautiful, collaborative documentation using super-powered Markdown.</p>
                            <p>I've also created
                                <a href="https://coderyouth.club" target="_blank">code community for teenagers</a>, built <a href="https://snaptier.co" target="_blank">a startup with two other teenagers</a>, and <a href="https://ghuser.io/m1guelpf"
                                    target="_blank">contributed to over 350 open source projects</a>.</p>
                            <p>You can checkout my open-source projects on
                                <a href="https://github.com/m1guelpf" target="_blank">GitHub</a>, follow me on
                                <a href="https://twitter.com/m1guelpf" target="_blank">Twitter</a>, or read my articles below. And, if you like what I do, please consider <a href="https://miguelpiedrafita.com/patreon">helping me achieve my dream</a> :)</p>
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