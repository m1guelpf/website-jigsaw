@extends('_layouts.ghost')

@section('body')
<div class="section-featured no-featured-image wrap">
    <center class="featured-wrap">
            <h1>404</h1>
            <h4>Page not found</h4>
            <a href="{{ $page->getBaseUrl() }}">Go to the front page →</a>
    </center>
</div>
        <div class="section-loop wrap ">
            <div class="items-wrap flex">
                @foreach(collect($posts)->take(3) as $post)
                    @include('_components.post_card', ['baseUrl' => $page->getBaseUrl()])
                @endforeach
            </div>
        </div>
@endsection
