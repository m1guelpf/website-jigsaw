<entry>
    <id>{{ $entry->getUrl() }}</id>
    <link type="text/html" rel="alternate" href="{{ $entry->getUrl() }}" />
    <title>{{ $entry->title }}</title>
    <published>{{ $entry->getDate()->format(DATE_ATOM) }}</published>
    <updated>{{ $entry->getDate()->format(DATE_ATOM) }}</updated>
    <author>
        <name>{{ $page->siteAuthor }}</name>
    </author>
    <summary type="html">{!! $entry->excerpt !!}...</summary>
    {{-- <content type="html"><![CDATA[
        {!! $entry->getContent() !!}
    ]]></content> --}}
</entry>
