@php
    /** @var \App\Models\UserMaterial $material */
    $type = \App\View\Components\Chunks\Sidebar::TYPE_MATERIAL;

    /** @var \App\Models\Comment[] $comments */
    $comments = $material->comments()->get()->all();
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
                    <article id="editorjs"
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
                                    <a href="#comments">
                                        {{ $material->comments()->count() }}
                                    </a>
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
                @php
                    /** @var \App\Models\UserMaterial $material */

                @endphp
                <div class="reply-form" style="display: none">
                    <form class="form comment-form ec-form" method="POST"
                          action="{{ route('material.comment', $material->slug) }}"
                          role="form">
                        @csrf
                        <input type="hidden" name="parent" value="">
                        <div class="form-group">
                            <label class="control-label">Ваше имя (не обязательно)</label>
                            <input type="text" name="username" class="form-control" placeholder="Иван Юрьевич">
                            <span class="field-error help-block" id="field-username"></span>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Электронная почта (не обязательно)</label>
                            <span class="small">Если хотите получать оповещения об ответах на комментарий</span>
                            <input type="text" name="email" class="form-control" placeholder="ivan_y@mail.ru">
                            <span class="field-error help-block" id="field-email"></span>
                        </div>

                        <div class="form-group">
                            <label for="ec-text-resource-34738" class="control-label">Ваше сообщение</label>
                            <textarea type="text" name="text" class="form-control" rows="5"></textarea>
                            <span class="field-error help-block" id="field-text"></span>
                        </div>


                        <div class="form-actions">
                            <input type="submit" class="btn btn-primary" name="send" value="Отправить">
                        </div>
                    </form>
                </div>
                <h3 class="comment-reply-title">Написать комментарий</h3>
                <form class="form comment-form ec-form" id="#comments" method="POST"
                      action="{{ route('material.comment', $material->slug) }}"
                      role="form">
                    @csrf
                    <div class="form-group">
                        <label class="control-label">Ваше имя (не обязательно)</label>
                        <input type="text" name="username" class="form-control" placeholder="Иван Юрьевич">
                        <span class="field-error help-block" id="field-username"></span>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Электронная почта (не обязательно)</label>
                        <span class="small">Если хотите получать оповещения об ответах на комментарий</span>
                        <input type="text" name="email" class="form-control" placeholder="ivan_y@mail.ru">
                        <span class="field-error help-block" id="field-email"></span>
                    </div>

                    <div class="form-group">
                        <label for="ec-text-resource-34738" class="control-label">Ваше сообщение</label>
                        <textarea type="text" name="text" class="form-control" rows="5"></textarea>
                        <span class="field-error help-block" id="field-text"></span>
                    </div>


                    <div class="form-actions">
                        <input type="submit" class="btn btn-primary" name="send" value="Отправить">
                    </div>
                </form>


                <div id="comments" class="comments-area">
                    <h2 class="comments-title">
                        {{\DeclensionNoun::make(count($comments), 'комментарий')}}
                    </h2>

                    <div class="comment-list">
                        @include('components.comments', ['comments' => $comments])
                    </div>
                </div>
            </div>
            <x-chunks.sidebar type="{{ $type }}"></x-chunks.sidebar>
        </div>
    </div>

@endsection
