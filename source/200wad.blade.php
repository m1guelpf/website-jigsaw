@extends('_layouts.ghost')

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