@extends('layouts.base')

@section('content')
    <div class="container page-container">
        <div class="row">
            <div class="col-md-8">
                {{ $message }}
            </div>
            <x-chunks.sidebar type="{{ \App\View\Components\Chunks\Sidebar::TYPE_MATERIAL }}"></x-chunks.sidebar>
        </div>
    </div>
@endsection
