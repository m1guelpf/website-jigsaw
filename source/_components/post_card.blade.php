<div class="item-wrap flex post @foreach($post->tags as $tag) tag-{{ $tag['slug'] }}@endforeach {{ $post->featured ? 'featured':'' }} {{ $post->cover_image != null ? 'is-image':'' }}">
    <article>
        <a href="{{ $baseUrl.'/'.$post->slug }}" class="item-link-overlay"></a>
        @if($post->cover_image != null)
            <div class="item-image" style="background-image: url({{ $post->cover_image }})"></div>
        @endif
        <h2><a href="{{ $baseUrl.'/'.$post->slug }}" class="white">{{ $post->title }}</a></h2>
        <div class="item-meta white is-primary-tag">
            <time datetime="{{ $page->getDate($post)->format('YYYY-MM-DD') }}">{{ $page->getDate($post)->diffForHumans() }}</time>
        </div>
        @if(! collect($post->tags)->where('internal', false)->isEmpty())
            <a class="primary-tag global-tag white" href="{{ $baseUrl.'/tag/'.collect($post->tags)->where('internal', false)->first()['slug'] }}">{{ collect($post->tags)->where('internal', false)->first()['name'] }}</a>
        @endisset
    </article>
</div>