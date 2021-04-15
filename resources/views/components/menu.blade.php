@php
/** @var \App\Models\Region[] $regions */
@endphp

<header class="main-header clearfix sticky-header">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="header-left">
                    <div class="mainmenu-mobile-toggle" aria-label="Toggle menu"><i class="fa fa-bars"
                                                                                    aria-hidden="true"></i></div>
                    <div class="logo">
                        <a class="logo-link" href="/">
                            <img srcset="/img/logo_2x.png 2x" src="/img/logo.png" alt="южная служба новостей лого"
                                 class="regular-logo">
                        </a>
                    </div>
                </div>
                <div class="header-center">
                    <div class="mainmenu mainmenu-none mainmenu-regularfont mainmenu-noarrow clearfix"
                         role="navigation">
                        <div id="navbar" class="navbar navbar-default clearfix mgt-mega-menu">
                            <div class="navbar-inner">
                                <div class="container">
                                    <div class="navbar-toggle btn btn-grey" data-toggle="collapse"
                                         data-target=".collapse">
                                        Menu
                                    </div>
                                    <div class="navbar-center-wrapper">
                                        <div class="navbar-collapse collapse">
                                            <ul id="menu-main-menu-2" class="nav">
                                                <li id="mgt-menu-item-104"
                                                    class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home current-menu-ancestor menu-item-has-children">
                                                    <a href="/">Главная</a>
                                                </li>
                                                <li id="mgt-menu-item-105"
                                                    class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children mgt-menu-fullwidth-inside">
                                                    <a href="category.html">Рубрики</a>
                                                    <ul class="sub-menu">
                                                        @foreach($categories as $category)
                                                            <li id="mgt-menu-item-443"
                                                                class="menu-item menu-item-type-custom menu-item-object-custom">
                                                                <a href="{{route('category.material', $category->slug)}}">
                                                                    {{$category->name}}
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                                <li id="mgt-menu-item-105"
                                                    class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children mgt-menu-fullwidth-inside">
                                                    <a href="#">Регионы</a>
                                                    <ul class="sub-menu">
                                                        @foreach($regions as $region_category)
                                                            <li id="mgt-menu-item-443"
                                                                class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children">
                                                                <a href="#">{{$region_category->name}}</a>
                                                                <ul class="sub-menu  level-1">
                                                                    @foreach($region_category->regions as $region)
                                                                        <li id="mgt-menu-item-536"
                                                                            class="menu-item menu-item-type-custom menu-item-object-custom">
                                                                            <a href="{{$region->getLink()}}">{{$region->name}}</a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                                <li class="menu-item menu-item-type-taxonomy menu-item-object-category">
                                                    <a href="news.html">
                                                        Новости
                                                        <sup style="background-color: #db564f">Hot</sup>
                                                    </a>
                                                </li>
                                                <li id="mgt-menu-item-326"
                                                    class="menu-item menu-item-type-post_type menu-item-object-page">
                                                    <a href="special.html">Спецпроекты</a>
                                                </li>
                                                <li id="mgt-menu-item-325"
                                                    class="menu-item menu-item-type-post_type menu-item-object-page">
                                                    <a href="column.html">Колумнистика</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="header-right">
                    <div class="search-toggle-wrapper search-header">
                        <form method="POST" role="search" class="searchform" action="{{ route('search') }}">
                            @csrf
                            <input type="search" class="field" id="search" name="query" placeholder="Введите запрос здесь">
                            <input type="submit" class="submit btn" value="Найти">
                        </form>
                        <a class="search-toggle-btn" aria-label="Search toggle">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
