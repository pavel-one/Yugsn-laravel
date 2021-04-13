@php
    /** @var \App\Models\UserMaterial $material */
    $typeIndex = \App\View\Components\Chunks\Sidebar::TYPE_INDEX;
@endphp

@extends('layouts.base')
@section('body-class')
    post-template-default single single-post single-format-gallery woocommerce-js blog-post-transparent-header-disable blog-small-page-width blog-slider-disable blog-enable-images-animations blog-enable-sticky-sidebar blog-enable-sticky-header blog-style-corners-rounded blog-post-header-with-bg
@endsection
@section('content')
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
                                        <a href="{{ $material->getAuthorLink() }}">
                                            <img src="{{ $material->getAuthorPhoto() }}" class="avatar avatar-28 photo"
                                                 height="28" width="28">
                                        </a>
                                    </div>
                                    <a style="display: inline-block; color: #555"
                                       href="{{ $material->getAuthorLink() }}">
                                        {{ $material->getAuthorName() }}
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
    <div class="post-container container span-col-md-8">
        <div class="row">
            <div class="col-md-8">
                <div class="blog-post blog-post-single clearfix">
                    <article
                        class="post type-post status-publish format-standard has-post-thumbnail hentry category-lifestyle tag-business tag-design tag-finance tag-phones tag-technology">
                        <div class="post-content-wrapper">
                            <div class="post-content clearfix">
                                <div class="entry-content">
                                    {!! $material->content !!}
                                </div>

                                @include('components.chunks.share')
                            </div>
                        </div>
                    </article>
                    <div class="saxon-post saxon-post-bottom">
                        <div class="post-details-bottom">
                            <div class="post-info-tags">
                                @if ($material->tags)
                                    <div class="tags clearfix">
                                        @foreach ($material->tags as $tag)
                                            <a href="{{ route('tag', urlencode($tag)) }}" rel="tag">{{$tag}}</a>
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                            <div class="post-info-wrapper">
                                <div class="post-info-comments"
                                     style="display: flex; flex-direction: row; align-items: center">
                                    <i class="fa fa-comment-o" aria-hidden="true"></i>
                                    <a href="#comments">0</a>
                                </div>

                                <div class="post-info-views"
                                     style="display: flex; flex-direction: row; align-items: center;">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                    457
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
                <div class="author-bio aos-init aos-animate" data-aos="fade-up">
                    <div class="author-image">
                        <a href="/user/7">
                            <img src="https://www.gravatar.com/avatar/c2a482ace9da936b9c4c7e6c0afc74c9?s=170&amp;d=mm"
                                 class="avatar avatar-post photo">
                        </a>
                    </div>
                    <div class="author-info">
                        <h5>Об авторе</h5>
                        <h3>
                            <a href="/user/7" title="Аркадий Талисвейбер " rel="author">
                                Аркадий Талисвейбер </a>
                        </h3>
                        <div class="author-description">
                        </div>

                    </div>
                    <div class="clear"></div>
                </div>
                <nav id="nav-below" class="navigation-post">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 nav-post-prev saxon-post">
                                <div class="saxon-post-image-wrapper">
                                    <a href="/minstroj-rostovskoj-oblasti-poruchil-glavam-municzipalitetov-ustranit-zamechaniya-v-kvartirax-detej-sirot/">
                                        <div class="saxon-post-image"
                                             data-style="background-image: url(/assets/components/phpthumbof/cache/1njhimg-20210401-wa0008.a27f69e39fea0fe45cef90761681e736.jpg);"
                                             style="background-image: url(/assets/components/phpthumbof/cache/1njhimg-20210401-wa0008.a27f69e39fea0fe45cef90761681e736.jpg);">

                                        </div>
                                    </a>
                                </div>
                                <a href="/minstroj-rostovskoj-oblasti-poruchil-glavam-municzipalitetov-ustranit-zamechaniya-v-kvartirax-detej-sirot/"
                                   class="nav-post-title-link">
                                    <div class="nav-post-title">Предыдущая</div>
                                    <div class="nav-post-name">
                                        Минстрой Ростовской области поручил главам муниципалитетов устранить замечания в
                                        квартирах детей-сирот
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-6 nav-post-next saxon-post">
                                <a href="/v-prigorode-sochi-postroyat-shkolnyij-blok-na-400-mest-i-blagoustroyat-plyazh/"
                                   class="nav-post-title-link">
                                    <div class="nav-post-title">Следующая</div>
                                    <div class="nav-post-name">
                                        В пригороде Сочи построят школьный блок на 400 мест и благоустроят пляж
                                    </div>
                                </a>
                                <div class="saxon-post-image-wrapper">
                                    <a href="/v-prigorode-sochi-postroyat-shkolnyij-blok-na-400-mest-i-blagoustroyat-plyazh/">
                                        <div class="saxon-post-image"
                                             data-style="background-image: url(/assets/components/phpthumbof/cache/szowe01de47c1bac4fda48559516cf8ecb94.a27f69e39fea0fe45cef90761681e736.jpg);"
                                             style="background-image: url(/assets/components/phpthumbof/cache/szowe01de47c1bac4fda48559516cf8ecb94.a27f69e39fea0fe45cef90761681e736.jpg);">

                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
                <x-chunks.subscribe></x-chunks.subscribe>

                <div class="clear"></div>
                <div id="comments" class="comments-area">
                    <h2 class="comments-title">
                        0 комментариев </h2>

                    <ul class="comment-list">
                    </ul>
                </div>

                <h3 class="comment-reply-title">Написать комментарий</h3>
                <form class="form ec-form" method="post" role="form">
                    <div class="form-group">
                        <label for="ec-user_name-resource-34738" class="control-label">Ваше имя</label>
                        <input type="text" name="user_name" class="form-control" id="ec-user_name-resource-34738"
                               value="" placeholder="Иван Юрьевич">
                        <span class="ec-error help-block" id="ec-user_name-error-resource-34738"></span>
                    </div>

                    <div class="form-group">
                        <label for="ec-user_email-resource-34738" class="control-label">Электронная почта</label>
                        <input type="text" name="user_email" class="form-control" id="ec-user_email-resource-34738"
                               placeholder="ivan_y@mail.ru" value="">
                        <span class="ec-error help-block" id="ec-user_email-error-resource-34738"></span>
                    </div>

                    <div class="form-group">
                        <label for="ec-text-resource-34738" class="control-label">Ваше сообщение</label>
                        <textarea type="text" name="text" class="form-control" rows="5"
                                  id="ec-text-resource-34738"></textarea>
                        <span class="ec-error help-block" id="ec-text-error-resource-34738"></span>
                    </div>


                    <div class="form-actions">
                        <input type="submit" class="btn btn-primary" name="send" value="Отправить">
                    </div>
                </form>
            </div>
            <x-chunks.sidebar type="{{ $typeIndex }}"></x-chunks.sidebar>
        </div>
    </div>

@endsection
