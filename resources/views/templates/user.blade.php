@php
    /** @var \App\Models\User $user */
@endphp

@extends('layouts.base')

@section('content')
    <div class="container container-page-item-title aos-init aos-animate" data-aos="fade-up">
        <div class="row">
            <div class="col-md-12">
                <div class="page-item-title-archive page-item-title-single">
                    <p>Автор</p>
                    <div class="author-avatar">
                        <img src="https://www.gravatar.com/avatar/c2a482ace9da936b9c4c7e6c0afc74c9?s=170&amp;d=mm" class="avatar avatar-100 photo" height="100" width="100">
                    </div>
                    <h1 class="page-title">
                        <span class="vcard">{{ $user->name ?? 'Скрыто' }}</span>
                    </h1>
                    <div class="category-posts-count">{{ $count }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
