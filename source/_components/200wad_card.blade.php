<div class="item-wrap flex post tag-hash-{{ $post->accent }}">
    <article>
        <a href="{{ $baseUrl.'/200wad/'.$post->slug }}" class="item-link-overlay"></a>
        <h2><a href="{{ $baseUrl.'/200wad/'.$post->slug }}" class="white">{!! $post->title !!}</a></h2>
        <div class="item-meta white">
            <span><time datetime="{{ $page->getDate($post)->format('YYYY-MM-DD') }}" style="margin-right:0;">Day #{{ $post->day }}</time> &bull; {{ $post->word_count }} words &bull; {{ $post->reading_time }}</span>
            {{-- <p>Day #{{ $post->day }} &bull; {{ $post->word_count }} words &bull; {{ $post->reading_time }}</p> --}}
        </div>
    </article>
</div>