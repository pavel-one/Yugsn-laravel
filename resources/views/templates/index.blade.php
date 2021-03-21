@extends('layouts.base')

@section('content')
    <!--first block-->
    <x-index.first-block></x-index.first-block>
    <x-index.second-block></x-index.second-block>
    <div class="container">
        <div class="row">
            <div class="col-md-12 saxon-block-button alcen" data-aos="fade-up">
                <a href="{{ route('news') }}" class="btn btn-grey btn-load-more">
                    Смотреть все
                </a>
            </div>
        </div>
    </div>
    <x-index.list-categories :limit="4" :offset="0"></x-index.list-categories>
    <x-chunks.subscribe></x-chunks.subscribe>

    <x-index.list-crime categoryName="Криминал" :limit="8"></x-index.list-crime>
    <x-index.list-society-block categoryName="Общество" :limit="4"></x-index.list-society-block>
@endsection
