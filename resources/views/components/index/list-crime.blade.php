@php
    /** @var \App\Models\UserMaterial[] $materials */
    /** @var \App\Models\UserMaterial $first */
    /** @var \App\Models\UserMaterial[] $secondMaterials */
    /** @var \App\Models\MaterialCategory $category */
@endphp

<div class="saxon-postsmasonry2-block-wrapper saxon-block">
    <div class="container">
        <div class="row">
            <div class="col-md-12 saxon-block-title">
                <h3>
                    <a href="{{ $category->getLink() }}">
                        {{ $category->name }}
                    </a>
                </h3>
            </div>

            <div class="col-md-5">
                <div class="saxon-postsmasonry2-post saxon-postsmasonry2_1-post saxon-post format- aos-init aos-animate"
                     data-aos="fade-up">
                    <div class="saxon-post-image-wrapper">
                        <a href="{{ $first->getLink() }}">
                            <div class="saxon-post-image"
                                 style="background-image: url({{$first->getFirstMediaUrl('default', 'thumb-normal-horizon')}});">
                            </div>
                        </a>
                        <div class="post-categories">
                            <a href="{{ $first->getLinkRegion() }}" class="mark region">
                                {{ $first->getNameRegion() }}
                            </a>
                        </div>
                    </div>
                    <div class="saxon-post-details">
                        <h3 class="post-title">
                            <a href="{{ $first->getLink() }}">
                                {{ $first->title }}
                            </a>
                        </h3>
                        <div class="post-date">
                            {{ $first->getPublishedTime() }}
                        </div>
                    </div>
                    <div class="post-excerpt">
                        {{ $first->getSmallContent() }}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                @foreach($secondMaterials as $material)
                    <div class="saxon-postsmasonry2-post saxon-postsmasonry2_2-post saxon-post aos-init aos-animate"
                         data-aos="fade-up">
                        <div class="saxon-post-image-wrapper">
                            <a href="{{ $material->getLink() }}">
                                <div class="saxon-post-image"
                                     style="background-image: url({{$material->getFirstMediaUrl('default', 'thumb-normal')}});">
                                </div>
                            </a>
                            <div class="post-categories">
                                <a href="{{ $material->getLinkRegion() }}" class="mark region">
                                    {{ $material->getNameRegion() }}
                                </a>
                            </div>
                        </div>
                        <div class="saxon-post-details">

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
                @endforeach
            </div>
            <div class="col-md-3">
                @foreach($materials as $material)
                    <div class="saxon-postsmasonry2-post saxon-postsmasonry2_3-post saxon-post aos-init aos-animate"
                         data-aos="fade-up">
                        <div class="post-categories">
                            <a href="{{ $material->getLinkRegion() }}" class="mark region">
                                {{ $material->getNameRegion() }}
                            </a>
                        </div>
                        <div class="saxon-post-details">
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
                @endforeach
            </div>
            <div class="col-md-12 saxon-block-button" data-aos="fade-up" style="margin: 60px 0 0">
                <a href="{{ $category->getLink() }}" class="btn btn-grey btn-load-more">
                    Смотреть еще
                </a>
            </div>
        </div>
    </div>
</div>
