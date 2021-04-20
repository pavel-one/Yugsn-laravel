@extends('layouts.base')

@section('content')
    <div class="container page-container">
        <h1 class="title">Авторизация</h1>
        <div class="row">
            <div class="col-md-8">
                <form action="{{ route('login.auth') }}" id="login" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="control-label">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="ivan@mail.ru">
                        <span class="field-error help-block" id="field-email"></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Пароль</label>
                        <input type="password" name="password" class="form-control">
                        <span class="field-error help-block" id="field-password"></span>
                    </div>
                    <button class="btn btn-success">Войти</button>
                </form>
            </div>
            <x-chunks.sidebar type="{{ \App\View\Components\Chunks\Sidebar::TYPE_MATERIAL }}"></x-chunks.sidebar>
        </div>
    </div>
@endsection
