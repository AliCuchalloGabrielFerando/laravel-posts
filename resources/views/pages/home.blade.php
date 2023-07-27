@extends('layout')

@section('content')
    <section class="posts container">
        @if (isset($title))
            <h3>{{ $title }}</h3>
        @endif
        @foreach ($posts as $post)
            <article class="post">
                @if ($post->photos->count() === 1)
                    <div class="gallery-photos" data-masonry='{"itemSelector": ".grid-item", "columnWidth": 464}'>
                        <figure class="grid-item grid-item--height2">
                            <img src="{{ url($post->photos->first()->url) }}" alt="" class="img-responsive">
                        </figure>
                    </div>
                @elseif($post->photos->count() > 1)
                    <div class="gallery-photos" data-masonry='{"itemSelector": ".grid-item", "columnWidth": 464}'>
                        @foreach ($post->photos->take(2) as $photo)
                            <figure class="grid-item grid-item--height2">
                                @if ($loop->iteration === 2)
                                    <div class="overlay">{{ $post->photos->count() }} Fotos</div>
                                @endif
                                <img src="{{ url($photo->url) }}" class="img-responsive" alt="">
                            </figure>
                        @endforeach
                    </div>
                @elseif($post->iframe)
                    <div class="video">
                        {!! $post->iframe !!}
                    </div>
                @endif

                <div class="content-post">

                    @include('posts.header')
                    
                    <h1>{{ $post->title }}</h1>
                    <div class="divider"></div>
                    <p>{{ $post->excerpt }}</p>
                    <footer class="container-flex space-between">
                        <div class="read-more">
                            <a href=" {{route('posts.show',$post)}}" class="text-uppercase c-green">read more</a>
                        </div>
                        @include('posts.tags')
                    </footer>
                </div>
            </article>
        @endforeach

    </section><!-- fin del div.posts.container -->
    {{ $posts->links() }}
@endsection
