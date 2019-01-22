@extends('_layouts.ghost')

@section('body-class', 'error-template')

@section('body')
<div class="section-error flex">
    <div class="error-wrap">
        <h2>404</h2>
        <p>Page not found</p>
        <a href="{{ $page->getBaseUrl() }}" class="subscribe-back-button error-back-button">Back to Homepage</a>
    </div>
</div>
@endsection
