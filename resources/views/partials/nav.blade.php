<nav class="custom-wrapper" id="menu">
    <div class="pure-menu"></div>
    <ul class="container-flex list-unstyled">
        <li><a href="{{route('pages.home')}}" class="text-uppercase {{request()->routeIs('pages.home')? 'active':''}}">Home</a></li>
        <li><a href="{{route('pages.about')}}" class="text-uppercase {{request()->routeIs('pages.about')? 'active':''}}">About</a></li>
        <li><a href="{{route('pages.archive')}}" class="text-uppercase {{request()->routeIs('pages.archive')? 'active':''}}">Archive</a></li>
        <li><a href="{{route('pages.contact')}}" class="text-uppercase {{request()->routeIs('pages.contact')? 'active':''}}">Contact</a></li>
    </ul>
</nav>