@php
    /** @var \App\Models\UserMaterial[] $materials */
@endphp

@extends('layouts.base')

@section('content')
    <div class="container container-page-item-title aos-init aos-animate" data-aos="fade-up">
        <div class="row">
            <div class="row">
                <div class="page-item-title-search">
                    <div class="saxon-post-single saxon-post aos-init aos-animate" data-aos="fade-up">
                        <div class="saxon-post-details" style="text-align: left">
                            <h1 class="post-title" style="color: #555; margin: 10px 0">
                                {{ $tag }}
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('components.chunks.simple-list')
@endsection
