@foreach($categories as $category)
    @php
        /** @var \App\Models\MaterialCategory $category */
        /** @var \App\Models\UserMaterial $material */
        /** @var \App\Models\UserMaterial[] $materials */

        $materials = \App\Models\UserMaterial::findMini($category, true)->limit(3)->get()->all();
    @endphp

    @if(count($materials) > 1)
{{--   TODO: WTF DONT WORK     --}}
        @continue
    @endif

    @switch($loop->index)
        @case(1)
        <div class="saxon-postsmasonry1-block-wrapper saxon-block">
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
                        @if($loop->index === 0)
                            <div class="col-md-7">
                                <div class="saxon-postsmasonry1-post saxon-postsmasonry1_1-post saxon-post"
                                     data-aos="fade-up">
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
                                </div>
                            </div>
                        @else
                            <div class="col-md-5">
                                <div class="saxon-postsmasonry1-post saxon-postsmasonry1_2-post saxon-post"
                                     data-aos="fade-up">
                                    <div class="saxon-post-image-wrapper">
                                        <a href="{{ $material->getLink() }}">
                                            <div class="saxon-post-image"
                                                 style="background-image: url({{$material->getFirstMediaUrl('default', 'thumb-normal-horizon')}});">
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
                            </div>
                        @endif
                    @endforeach
                    <div class="col-md-12 saxon-block-button" data-aos="fade-up" style="margin: 30px 0 0">
                        <a href="{{ $category->getLink() }}" class="btn btn-grey btn-load-more">
                            Смотреть еще
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @break
        @case(3)
        <div class="saxon-postsgrid2-block-wrapper saxon-block">
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
                        @if(!$loop->last)
                            <div class="col-md-6">
                                <div class="saxon-overlay-post saxon-post saxon-post-invert" data-aos="fade-up">
                                    <div class="saxon-post-wrapper-inner">
                                        <div class="saxon-post-image"
                                             style="background-image: url({{$material->getFirstMediaUrl('default', 'thumb-normal-big')}});">
                                        </div>
                                        <div class="saxon-post-details">
                                            <div class="post-categories">
                                                <a href="{{ $material->getLinkRegion() }}" class="mark region">
                                                    {{ $material->getNameRegion() }}
                                                </a>
                                            </div>
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
                        @endif
                    @endforeach
                    <div class="col-md-12 saxon-block-button" data-aos="fade-up">
                        <a href="{{ $category->getLink() }}" class="btn btn-grey btn-load-more">
                            Смотреть еще
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @break
        @default
        <div class="saxon-postsgrid1-block-wrapper saxon-block">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 saxon-block-title">
                        <h3>
                            <a href="{{ $category->getLink() }}">
                                {{$category->name}}
                            </a>
                        </h3>
                    </div>
                    @foreach($materials as $material)
                        <div class="col-md-4">
                            <div class="saxon-grid-post saxon-grid-info-post saxon-post" data-aos="fade-up">
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
                                    {!! $material->getSmallContent()  !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-md-12 saxon-block-button" data-aos="fade-up">
                        <a href="{{ $category->getLink() }}" class="btn btn-grey btn-load-more">
                            Смотреть еще
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endswitch

@endforeach
