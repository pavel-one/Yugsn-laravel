@php
    /** @var \App\Models\MaterialCategory $category */
    /** @var \App\Models\UserMaterial[] $materials */
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
        <div class="col-md-4 main-sidebar sidebar sidebar-right" data-aos="fade-up" role="complementary">
            <ul id="main-sidebar">
                <li id="saxon-list-posts-4" class="widget widget_saxon_list_entries">
                    <h2 class="widgettitle">
                        <a href="#to-category" class="aside-title-link">Культура</a>
                    </h2>
                    <ul>
                        <li class="template-shortline">
                            <div class="saxon-shortline-post saxon-post" data-aos="fade-up">
                                <div class="saxon-post-image-wrapper">
                                    <a href="#">
                                        <div class="saxon-post-image"
                                             style="background-image: url(http://wp.wp-preview.com/saxon/saxon-3/wp-content/uploads/2018/11/saxon-003-015-110x90.jpg);">
                                        </div>
                                    </a>
                                </div>
                                <div class="saxon-post-details">
                                    <div class="post-categories">
                                        <a href="#region-page" class="mark region">Регион</a>
                                    </div>
                                    <h3 class="post-title">
                                        <a href="#">How
                                            to explore the Republic of Ireland, guided entirely by local
                                            advice
                                        </a>
                                    </h3>
                                    <div class="post-date">26 октября 2018</div>
                                </div>
                            </div>
                        </li>
                        <li class="template-shortline">
                            <div class="saxon-shortline-post saxon-post" data-aos="fade-up">
                                <div class="saxon-post-image-wrapper">
                                    <a href="#">
                                        <div class="saxon-post-image"
                                             style="background-image: url(http://wp.wp-preview.com/saxon/saxon-3/wp-content/uploads/2018/11/saxon-003-011-110x90.jpg);">
                                        </div>
                                    </a>
                                </div>
                                <div class="saxon-post-details">
                                    <div class="post-categories">
                                        <a href="#region-page" class="mark region">Регион</a>
                                    </div>
                                    <h3 class="post-title"><a href="#">Recount
                                            Ordered in Florida Senate Race as Governor’s Contest Nears End</a>
                                    </h3>
                                    <div class="post-date">26 октября 2018</div>
                                </div>
                            </div>
                        </li>
                        <li class="template-shortline">
                            <div class="saxon-shortline-post saxon-post" data-aos="fade-up">
                                <div class="saxon-post-image-wrapper"><a href="#">
                                        <div class="saxon-post-image"
                                             style="background-image: url(http://wp.wp-preview.com/saxon/saxon-3/wp-content/uploads/2018/11/saxon-003-003-110x90.jpg);">
                                        </div>
                                    </a>
                                </div>
                                <div class="saxon-post-details">
                                    <div class="post-categories">
                                        <a href="#region-page" class="mark region">Регион</a>
                                    </div>
                                    <h3 class="post-title"><a href="#">Why
                                            Amazon Chose the Wrong Locations for Its HQ2</a></h3>
                                    <div class="post-date">26 октября 2018</div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
                <li>
                    <div class="col-md-12 saxon-block-button" data-aos="fade-up">
                        <a href="#" class="btn btn-grey btn-load-more">Смотреть еще</a>
                    </div>
                </li>
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
                        <li class="template-postsmasonry1-2">
                            <div class="saxon-postsmasonry1-post saxon-postsmasonry1_2-post saxon-post format-"
                                 data-aos="fade-up">
                                <div class="saxon-post-image-wrapper">
                                    <a href="#">
                                        <div class="saxon-post-image"
                                             style="background-image: url(http://wp.wp-preview.com/saxon/saxon-3/wp-content/uploads/2018/11/saxon-003-007-1140x694.jpg);">
                                        </div>
                                    </a>
                                    <div class="post-categories">
                                        <a href="#region-page" class="mark region">Регион</a>
                                        <a href="#category-page" class="mark category">Категория</a>
                                    </div>
                                </div>
                                <div class="saxon-post-details">
                                    <h3 class="post-title"><a href="#">How
                                            Silicon Valley activism is changing the technology industry</a></h3>
                                    <div class="post-date">26 октября 2018</div>
                                </div>
                            </div>
                        </li>
                        <li class="template-postsmasonry1-2">
                            <div class="saxon-postsmasonry1-post saxon-postsmasonry1_2-post saxon-post format-"
                                 data-aos="fade-up">
                                <div class="saxon-post-image-wrapper">
                                    <a href="#">
                                        <div class="saxon-post-image"
                                             style="background-image: url(http://wp.wp-preview.com/saxon/saxon-3/wp-content/uploads/2018/11/saxon-003-005-1140x694.jpg);">
                                        </div>
                                    </a>
                                    <div class="post-categories">
                                        <a href="#region-page" class="mark region">Регион</a>
                                        <a href="#category-page" class="mark category">Категория</a>
                                    </div>
                                </div>
                                <div class="saxon-post-details">
                                    <h3 class="post-title">
                                        <a href="#">Julian
                                            Assange charged in US, court document accidentally reveals</a>
                                    </h3>
                                    <div class="post-date">26 октября 2018</div>
                                </div>
                            </div>
                        </li>
                        <li class="template-postsmasonry1-2">
                            <div class="saxon-postsmasonry1-post saxon-postsmasonry1_2-post saxon-post format-"
                                 data-aos="fade-up">
                                <div class="saxon-post-image-wrapper">
                                    <a href="#">
                                        <div class="saxon-post-image"
                                             style="background-image: url(http://wp.wp-preview.com/saxon/saxon-3/wp-content/uploads/2018/11/saxon-003-015-1140x694.jpg);">
                                        </div>
                                    </a>
                                    <div class="post-categories">
                                        <a href="#region-page" class="mark region">Регион</a>
                                        <a href="#category-page" class="mark category">Категория</a>
                                    </div>
                                </div>
                            </div>
                            <div class="saxon-post-details">
                                <h3 class="post-title"><a href="#">How
                                        to explore the Republic of Ireland, guided entirely by local
                                        advice</a></h3>
                                <div class="post-date">26 октября 2018</div>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
