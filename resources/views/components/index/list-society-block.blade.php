@php
    /** @var \App\Models\UserMaterial[] $materials */
    /** @var \App\Models\MaterialCategory $category */
@endphp

<div class="saxon-postsgrid3-block-wrapper saxon-block">
    <div class="container">
        <div class="row">
            <div class="col-md-12 saxon-block-title">
                <h3>
                    <a href="{{ $category->getLink() }}">
                        {{ $category->name }}
                    </a>
                </h3>
            </div>
            @foreach($materials as $material)
                <div class="col-md-3">
                    <div class="saxon-overlay-alt-post saxon-post society-mini saxon-post-invert" data-aos="fade-up">
                        <div class="saxon-post-wrapper-inner">
                            <div class="saxon-post-image"
                                 style="background-image: url({{$material->getFirstMediaUrl('default', 'thumb-small-vertical')}});">
                            </div>
                            <div class="saxon-post-details">
                                @if($material->getNameRegion())
                                    <div class="post-categories">
                                        <a href="{{ $material->getLinkRegion() }}" class="mark region">
                                            {{ $material->getNameRegion() }}
                                        </a>
                                    </div>
                                @endif
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
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-md-12 saxon-block-button" data-aos="fade-up">
            <a href="{{ $category->getLink() }}" class="btn btn-grey btn-load-more">
                Смотреть еще
            </a>
        </div>
    </div>
</div>
