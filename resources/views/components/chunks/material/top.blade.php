@php
    /** @var \App\Models\UserMaterial $material */
@endphp

<div class="container container-page-item-title with-bg aos-init aos-animate" data-aos="fade-up">
    <div class="row">
        <div class="row">
            <div class="page-item-title-single" style="padding: 10px 0">
                <div class="saxon-post-single saxon-post aos-init aos-animate" data-aos="fade-up">
                    <div class="post-categories" style="justify-content: flex-start">
                        <a href="{{ $material->getLinkCategory() }}" data-style="background-color: #4dcf8f;"
                           style="background-color: #4dcf8f;">
                            {{ $material->getNameCategory() }}
                        </a>
                    </div>
                    <div class="saxon-post-details" style="text-align: left">
                        <h1 class="post-title" style="color: #555; margin: 10px 0">
                            {{ $material->long_title ?? $material->title }}
                        </h1>
                        <div
                            style="display: flex; flex-direction: row; flex-wrap: wrap; justify-content: flex-start; align-items: center">
                            <div class="post-author">
                                <div class="post-author-image">
                                    <a href="{{ $material->user->getLink() }}">
                                        <img src="{{ $material->getAuthorPhoto() }}" class="avatar avatar-28 photo"
                                             height="28" width="28">
                                    </a>
                                </div>
                                <a style="display: inline-block; color: #555"
                                   href="{{ $material->user->getLink() }}">
                                    {{ $material->user->getAuthorName() }}
                                </a>
                            </div>
                            <div class="post-date" style="color: #999">
                                {{ $material->getPublishedTime() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
