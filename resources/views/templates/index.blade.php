@extends('layouts.base')

@section('content')
    <!--first block-->
    <x-index.first-block></x-index.first-block>
    <x-index.second-block></x-index.second-block>
    <div class="container">
        <div class="row">
            <div class="col-md-12 saxon-block-button alcen" data-aos="fade-up">
                <a href="news.html" class="btn btn-grey btn-load-more">
                    Смотреть
                    еще
                </a>
            </div>
        </div>
    </div>
    <x-index.list-categories></x-index.list-categories>
@endsection
