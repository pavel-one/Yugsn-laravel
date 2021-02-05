<div>
    <div class="saxon-showcase1-block-wrapper saxon-block">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="saxon-overlay-alt-post saxon-post saxon-post-invert" data-aos="fade-up">
                        <div class="saxon-post-wrapper-inner">
                            <div class="saxon-post-image"
                                 style="background-image: url(https://yugsn.ru/assets/users/27/27-19150-oa0pl4.jpg);">
                            </div>
                            <div class="saxon-post-details">
                                <div class="post-categories">
                                    <a href="#category-page" class="mark category">
                                        {{ $material_big->category->name }}
                                    </a>
                                    <a href="#region-page" class="mark region">Москва</a>
                                </div>
                                <div class="saxon-post-details-inner">

                                    <h3 class="post-title">
                                        <a href="#">{{ $material_big->title }}</a>
                                    </h3>
                                    <div class="post-date">{{ $material_big->published_time->diffForHumans() }}</div>
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
                                        <a href="#category-page" class="mark category">
                                            {{ $material->category->name }}
                                        </a>
                                        <a href="#region-page" class="mark region">Ростовская область</a>
                                    </div>
                                    <div class="saxon-post-details-inner">

                                        <h3 class="post-title">
                                            <a href="#">
                                                {{ $material->title }}
                                            </a>
                                        </h3>
                                        <div class="post-date">
                                            {{ $material->published_time->diffForHumans() }}
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
