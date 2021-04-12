@php
    /** @var \App\Models\MaterialCategory $category */
    /** @var \App\Models\UserMaterial[] $materials */
    /** @var \App\Models\UserMaterial[] $populars */

@endphp

<div class="col-md-4 main-sidebar sidebar sidebar-right" data-aos="fade-up" role="complementary">
    <ul id="main-sidebar">
        <li id="saxon-list-posts-4" class="widget widget_saxon_list_entries">
            <h2 class="widgettitle">
                <a href="{{ $category->getLink() }}" class="aside-title-link">
                    {{ $category->name }}
                </a>
            </h2>
            <ul>
                @foreach($materials as $material)
                    <li class="template-shortline">
                        <div class="saxon-shortline-post saxon-post" data-aos="fade-up">
                            <div class="saxon-post-image-wrapper">
                                <a href="#">
                                    <div class="saxon-post-image"
                                         style="background-image: url({{$material->getFirstMediaUrl('default', 'thumb-mini')}});">
                                    </div>
                                </a>
                            </div>
                            <div class="saxon-post-details">
                                @if($material->getNameRegion())
                                    <div class="post-categories">
                                        <a href="{{ $material->getLinkRegion() }}" class="mark region">
                                            {{ $material->getNameRegion() }}
                                        </a>
                                    </div>
                                @endif
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
                    </li>
                @endforeach
            </ul>
        </li>
        <li>
            <div class="col-md-12 saxon-block-button" data-aos="fade-up">
                <a href="{{ $category->getLink() }}" class="btn btn-grey btn-load-more">
                    Смотреть еще
                </a>
            </div>
        </li>
        <!--
        <li id="saxon-categories-2" class="widget widget_saxon_categories">
            <h2 class="widgettitle">
                Спецпроекты
            </h2>
            <div class="post-categories">
                <a href="#" style="background:#eba845;">Военное дело<span
                        class="post-categories-counter">3</span>
                </a>
                <a href="#" style="background:#4dcf8f;">Северный кавказ<span
                        class="post-categories-counter">8</span>
                </a>
                <a href="#" style="background:#1F5DEA">Терроризм/экстремизм<span
                        class="post-categories-counter">6</span>
                </a>
            </div>
        </li>
        -->
        <li id="saxon-social-icons-2" class="widget widget_saxon_social_icons">
            <h2 class="widgettitle">Мы в социальных сетях</h2>
            <div class="textwidget">
                <div class="social-icons-wrapper">
                    <a href="#" target="_blank" class="a-vk">
                        <i class="fa fa-vk"></i>
                    </a>
                    <a href="#" target="_blank" class="a-odnoklassniki">
                        <i class="fa fa-odnoklassniki"></i>
                    </a>
                    <a href="#" target="_blank" class="a-facebook">
                        <i class="fa fa-facebook"></i>
                    </a>
                    <a href="#" target="_blank" class="a-twitter">
                        <i class="fa fa-twitter"></i>
                    </a>
                    <a href="#" target="_blank" class="a-instagram">
                        <i class="fa fa-instagram"></i>
                    </a>
                </div>
            </div>
        </li>
        <li id="saxon-list-posts-2" class="widget widget_saxon_list_entries">
            <h2 class="widgettitle">Популярное</h2>
            <ul>
                @foreach($populars as $material)
                    <li class="template-postsmasonry1-2">
                        <div class="saxon-postsmasonry1-post saxon-postsmasonry1_2-post saxon-post" data-aos="fade-up">
                            <div class="saxon-post-image-wrapper">
                                <a href="{{ $material->getLink() }}">
                                    <div class="saxon-post-image"
                                         style="background-image: url({{$material->getFirstMediaUrl('default', 'thumb-small-horizon')}});">
                                    </div>
                                </a>
                                <div class="post-categories">
                                    @if($material->getNameRegion())
                                        <a href="{{ $material->getLinkRegion() }}" class="mark region">
                                            {{ $material->getNameRegion() }}
                                        </a>
                                    @endif
                                    <a href="{{ $material->getLinkCategory() }}" class="mark category">
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
                        </div>
                    </li>
                @endforeach
            </ul>
        </li>
    </ul>
</div>
