@php
    /** @var \App\Models\MaterialCategory $category */
    /** @var \App\Models\UserMaterial[] $materials */

    $typeIndex = \App\View\Components\Chunks\Sidebar::TYPE_INDEX;
@endphp
<div class="saxon-block saxon-blog-block-wrapper page-container container columnistic">
    <div class="row">
        <div class="col-md-8 saxon-block-title">
            <h3>
                <a href="{{ $category->getLink() }}">
                    {{ $category->name }}
                </a>
            </h3>
        </div>
        <div class="col-md-8">
            <div class="blog-posts-list blog-layout-mixed-large-grid saxon-blog-col-mixed-2" id="content">
                @foreach($materials as $material)
                    @if($loop->first || $loop->index === 3)
                        <div class="blog-post saxon-block saxon-mixed-large-grid-post" data-aos="fade-up">
                            <article class="post type-post status-publish format-standard has-post-thumbnail hentry">
                                <div class="saxon-grid-post saxon-grid-large-post saxon-post" data-aos="fade-up">
                                    <div class="saxon-post-image-wrapper">
                                        <a href="{{ $material->getLink() }}">
                                            <div class="saxon-post-image"
                                                 style="background-image: url({{$material->getFirstMediaUrl('default', 'thumb-normal-big')}});">
                                            </div>
                                        </a>
                                        @if($material->getNameRegion())
                                            <div class="post-categories">
                                                <a href="{{ $material->getLinkRegion() }}" class="mark region">
                                                    {{ $material->getNameRegion() }}
                                                </a>
                                            </div>
                                        @endif
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
                                    <div class="post-excerpt">
                                        {{ $material->getSmallContent() }}
                                    </div>
                                    <div class="post-readmore">
                                        <a href="{{ $material->getLink() }}" class="more-link btn btn-grey">
                                            Читать далее
                                        </a>
                                    </div>
                                </div>
                            </article>
                        </div>
                    @else
                        <div class="blog-post saxon-block saxon-mixed-large-grid-post" data-aos="fade-up">
                            <article class="post type-post status-publish format-standard has-post-thumbnail hentry">
                                <div class="saxon-grid-post saxon-post" data-aos="fade-up">
                                    <div class="saxon-post-image-wrapper">
                                        <a href="{{ $material->getLink() }}">
                                            <div class="saxon-post-image"
                                                 style="background-image: url({{$material->getFirstMediaUrl('default', 'thumb-normal')}});">
                                            </div>
                                        </a>
                                        @if($material->getNameRegion())
                                            <div class="post-categories">
                                                <a href="{{ $material->getLinkRegion() }}" class="mark region">
                                                    {{ $material->getNameRegion() }}
                                                </a>
                                            </div>
                                        @endif
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
                                    <div class="post-excerpt">
                                        {{ $material->getSmallContent() }}
                                    </div>
                                </div>
                            </article>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="col-md-12 saxon-block-button" data-aos="fade-up">
                <a href="{{ $category->getLink() }}" class="btn btn-grey btn-load-more">
                    Смотреть еще
                </a>
            </div>
        </div>
        <x-chunks.sidebar type="{{ $typeIndex }}"></x-chunks.sidebar>
    </div>
</div>
