<div class="buttons-social-media-share">
    <ul class="share-buttons">
        <li><a href="https://www.facebook.com/sharer.php?u={{request()->fullUrl()}}&title={{$post->title}}" title="Compartir en Facebook"
                target="_blank"><img alt="Share on Facebook"
                    src="{{ url('img/flat_web_icon_set/Facebook.png') }}"></a></li>
        <li><a href="https://twitter.com/intent/tweet?url={{request()->fullUrl()}}&text={{$post->title}}&via=zendero&hashtags=zendero" target="_blank" title="Tweet"><img
                    alt="Tweet" src="{{ url('img/flat_web_icon_set/Twitter.png') }}"></a></li>
        
        <li><a href="http://pinterest.com/pin/create/button/?url={{request()->fullUrl()}}&description=" target="_blank"
                title="Pin it"><img alt="Pin it"
                    src="{{ url('img/flat_web_icon_set/Pinterest.png') }}"></a></li>
    </ul>
</div>