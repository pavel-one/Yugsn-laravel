<div>
    <div class="saxon-showcase1-block-wrapper saxon-block">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="saxon-overlay-alt-post saxon-post saxon-post-invert" data-aos="fade-up">
                        <div class="saxon-post-wrapper-inner">
                            <div class="saxon-post-image"
                                 style="background-image: url({{$material_big->getFirstMediaUrl('default', 'thumb-small-big')}});">
                            </div>
                            <div class="saxon-post-details">
                                <div class="post-categories">
                                    <a href="{{ $material_big->getLinkCategory() }}" class="mark category">
                                        {{ $material_big->getNameCategory() }}
                                    </a>
                                    <a href="{{ $material_big->getLinkRegion() }}" class="mark region">
                                        {{ $material_big->getNameRegion() }}
                                    </a>
                                </div>
                                <div class="saxon-post-details-inner">

                                    <h3 class="post-title">
                                        <a href="{{ route('category.material', $material_big->slug) }}">{{ $material_big->title }}</a>
                                    </h3>
                                    <div class="post-date">{{ $material_big->getPublishedTime() }}</div>
                                </div>
                                <!--
                                <a href="shop.html" class="lock-icon" title="Доступно только по платной подписке">
                                    <img src="img/lock-icon.svg" alt="lock icon" width="20px" height="20px">
                                </a>
                                -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    @foreach($materials as $material)
                        <div class="saxon-overlay-alt-post saxon-post saxon-post-invert" data-aos="fade-up">
                            <div class="saxon-post-wrapper-inner">
                                <div class="saxon-post-image"
                                     style="background-image: url({{$material->getFirstMediaUrl('default', 'thumb-small-horizon')}});">
                                </div>
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
                                    <div class="saxon-post-details-inner">

                                        <h3 class="post-title">
                                            <a href="{{ route('category.material', $material_big->slug) }}">
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
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @foreach($materials as $material)

    @endforeach
</div>
