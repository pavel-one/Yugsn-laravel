@php
    /** @var \App\Models\UserMaterial[] $materials */
@endphp

<div class="container page-container">
    <div class="row">
        <div class="col-md-8">
            @if($materials->count() === 0)
                <p>Записей пока что нет</p>
            @else
                <div class="blog-posts-list blog-layout-mixed-large-grid saxon-blog-col-mixed-2" id="content"
                     role="main">
                    @foreach($materials as $material)
                        @if($loop->first || ($loop->index % 3) === 0)
                            <div class="blog-post saxon-block saxon-mixed-large-grid-post aos-init aos-animate"
                                 data-aos="fade-up">
                                <article class="post type-post status-publish format-standard has-post-thumbnail hentry">
                                    <div class="saxon-grid-post saxon-grid-large-post saxon-post format- aos-init aos-animate"
                                        data-aos="fade-up">
                                        <div class="saxon-post-image-wrapper">
                                            <a href="{{ $material->getLink() }}">
                                                <div class="saxon-post-image"
                                                     style="background-image: url({{$material->getFirstMediaUrl('default', 'thumb-normal-big')}});">
                                                </div>
                                            </a>
                                            <div class="post-categories">
                                                <a href="{{ $material->getLinkCategory() }}" class="mark region">
                                                    {{ $material->getNameCategory() }}
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
                                        <div class="post-excerpt">
                                            {{ $material->getSmallContent() }}
                                        </div>
                                    </div>
                                </article>
                            </div>
                        @else
                            <div class="blog-post saxon-block saxon-mixed-large-grid-post aos-init aos-animate"
                                 data-aos="fade-up">
                                <article class="post type-post status-publish format-standard has-post-thumbnail hentry">
                                    <div class="saxon-grid-post saxon-grid-large-post saxon-post format- aos-init aos-animate"
                                         data-aos="fade-up">
                                        <div class="saxon-post-image-wrapper">
                                            <a href="{{ $material->getLink() }}">
                                                <div class="saxon-post-image"
                                                     style="background-image: url({{$material->getFirstMediaUrl('default', 'thumb-normal')}});">
                                                </div>
                                            </a>
                                            <div class="post-categories">
                                                <a href="{{ $material->getLinkCategory() }}" class="mark region">
                                                    {{ $material->getNameCategory() }}
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
                                        <div class="post-excerpt">
                                            {{ $material->getSmallContent() }}
                                        </div>
                                    </div>
                                </article>
                            </div>
                        @endif
                    @endforeach
                </div>
                {{ $materials->links() }}
            @endif
        </div>

        <x-chunks.sidebar categoryName="Наука" type="1"></x-chunks.sidebar>
    </div>
</div>
