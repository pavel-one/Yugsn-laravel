<div class="saxon-featured-categories-wrapper saxon-post saxon-post-invert second-block" data-aos="fade-up">
    <div class="container">
        <div class="row">
            @foreach($materials as $material)
                <div class="col-md-3">
                    <div class="saxon-featured-category saxon-post saxon-overlay-alt-post"
                         style="background-image: url({{$material->getFirstMediaUrl('default', 'thumb-small-vertical')}});"
                         data-aos="fade-up">
                        <div class="saxon-post-details">
                            <div class="post-categories">
                                <a href="{{ $material->getLinkCategory() }}" class="mark category">
                                    {{ $material->getNameCategory() }}
                                </a>
                                @if($material->getNameRegion())
                                    <a href="{{ $material->getLinkRegion() }}" class="mark region">
                                        {{ $material->getNameRegion() }}
                                    </a>
                                @endif
                            </div>
                        </div>
                        <div class="saxon-post-details-inner">
                            <h3 class="post-title">
                                <a href="{{ $material->getLink() }}">
                                    {{ $material->title }}
                                </a>
                            </h3>
                            <div class="post-date">
                                {{ $material->getPublishedTime() }}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
