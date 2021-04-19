@php
    /** @var \App\Models\UserMaterial $material */
    $typeIndex = \App\View\Components\Chunks\Sidebar::TYPE_INDEX;
@endphp

@extends('layouts.base')
@section('body-class')
    post-template-default single single-post single-format-gallery woocommerce-js blog-post-transparent-header-disable blog-small-page-width blog-slider-disable blog-enable-images-animations blog-enable-sticky-sidebar blog-enable-sticky-header blog-style-corners-rounded blog-post-header-with-bg
@endsection
@section('content')
    @include('components.chunks.material.top')
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
                                    {{ $material->views }}
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
                @include('components.chunks.material.author')
                @include('components.chunks.material.navigate')
                <x-chunks.subscribe></x-chunks.subscribe>

                <div class="clear"></div>
                <x-comments id="{{ $material->id }}"></x-comments>
            </div>
            <x-chunks.sidebar type="{{ $typeIndex }}"></x-chunks.sidebar>
        </div>
    </div>

@endsection
