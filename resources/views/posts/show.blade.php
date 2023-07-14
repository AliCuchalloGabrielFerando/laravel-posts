@extends('layout')

@section('meta-title', $post->title)
@section('meta-description', $post->excerpt)

@section('content')

    <article class="post container">
        @if ($post->photos->count() === 1)
            <figure><img src="{{ url($post->photos->first()->url) }}" alt="" class="img-responsive"></figure>
        @elseif($post->photos->count() > 1)
            @include('posts.carousel')
        @elseif($post->iframe)
            <div class="video">
                {!! $post->iframe !!}
            </div>
        @endif
        <div class="content-post">
            <header class="container-flex space-between">
                <div class="date">
                    <span class="c-gris">{{ $post->published_at->format('M d') }}</span>
                </div>
                <div class="post-category">
                    <span class="category">{{ $post->category->name }}</span>
                </div>
            </header>
            <h1>{{ $post->title }}</h1>
            <div class="divider"></div>
            <div class="image-w-text">
                {!! $post->body !!}
            </div>

            <footer class="container-flex space-between">
                @include('partials.social-links')
                <div class="tags container-flex">
                    @foreach ($post->tags as $tag)
                        <span class="tag c-gray-1 text-capitalize"># {{ $tag->name }}</span>
                    @endforeach
                </div>
            </footer>
            <div class="comments">
                <div class="divider"></div>
                <div id="disqus_thread"></div>
                @include('partials.disqus-scripts')
            </div><!-- .comments -->
        </div>
    </article>

@endsection
@push('styles')
@endpush
@push('scripts')
    <script id="dsq-count-scr" src="//zendero.disqus.com/count.js" async></script>
@endpush
<!--
    <link rel="stylesheet" type="text/css" href="/public/css/t-bootstrap.css">
    <script src="/public/js/t-bootstrap.js" async></script>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"
    integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v1.9.5/dist/alpine.js"></script>

-->
