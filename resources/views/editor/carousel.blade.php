<div class="content-slider">
    @foreach($images as $image)
        <div>
            <img src="{{ $image['url'] }}" alt="{{ $image['caption'] }}">
        </div>
    @endforeach
</div>
