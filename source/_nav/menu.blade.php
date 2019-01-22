<nav class="nav-wrap">
    <label for="toggle" class="nav-label hamburger hamburger-minus">
        <span class="hamburger-box">
            <span class="hamburger-inner"></span>
        </span>
    </label>
    <input type="checkbox" id="toggle" class="nav-toggle">
    <ul class="nav-list">
        @foreach($page->navigation as $item)
            <li class="nav-list-item">
                <a href="{{ $page->baseUrl.'/'.$item['path'] }}" class="nav-link nav-support-me">{{ $item['title'] }}</a>
                <span class="nav-dot"></span>
            </li>
        @endforeach
        <li class="nav-list-item" style="display: inline-flex;">
            <a class="nav-link" style="cursor: pointer;" id="theme-text">Darken me</a>
            <label class="switch">
                <input type="checkbox" id="theme-slider">
                <span class="slider round"></span>
            </label>
        </li>
        <li class="nav-list-item search-open"><span>Search</span><svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M18.420346,15.5800244 L24,21.1596784 L21.1596784,24 L15.5800244,18.420346 C13.9925104,19.4717887 12.088789,20.0841064 10.0420532,20.0841064 C4.49598037,20.0841064 0,15.5881261 0,10.0420532 C0,4.49598037 4.49598037,0 10.0420532,0 C15.5881261,0 20.0841064,4.49598037 20.0841064,10.0420532 C20.0841064,12.088789 19.4717887,13.9925104 18.420346,15.5800244 Z M10.0420532,16.0672851 C13.3696969,16.0672851 16.0672851,13.3696969 16.0672851,10.0420532 C16.0672851,6.71440951 13.3696969,4.01682129 10.0420532,4.01682129 C6.71440951,4.01682129 4.01682129,6.71440951 4.01682129,10.0420532 C4.01682129,13.3696969 6.71440951,16.0672851 10.0420532,16.0672851 Z"></path>
            </svg></li>
    </ul>
</nav>