@php
    /** @var \App\Models\UserMaterial $material */
@endphp
<nav id="nav-below" class="navigation-post">
    <div class="container-fluid">
        <div class="row">
            @if ($prev = $material->getPreviewMaterial())
                <div class="col-md-6 nav-post-prev saxon-post">
                    <div class="saxon-post-image-wrapper">
                        <a href="{{ $prev->getLink() }}">
                            <div class="saxon-post-image"
                                 style="background-image: url({{ $prev->getFirstMediaUrl('default', 'thumb-small-vertical') }});">
                            </div>
                        </a>
                    </div>
                    <a href="{{ $prev->getLink() }}"
                       class="nav-post-title-link">
                        <div class="nav-post-title">Предыдущая</div>
                        <div class="nav-post-name">
                            {{ $prev->title }}
                        </div>
                    </a>
                </div>
            @endif
            @if ($next = $material->getNextMaterial())
                <div class="col-md-6 nav-post-next saxon-post">
                    <a href="{{ $next->getLink() }}"
                       class="nav-post-title-link">
                        <div class="nav-post-title">Следующая</div>
                        <div class="nav-post-name">
                            {{ $next->title }}
                        </div>
                    </a>
                    <div class="saxon-post-image-wrapper">
                        <a href="{{ $next->getLink() }}">
                            <div class="saxon-post-image"
                                 style="background-image: url({{ $next->getFirstMediaUrl('default', 'thumb-small-vertical') }});">
                            </div>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</nav>
