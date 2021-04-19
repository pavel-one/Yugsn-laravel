@php
/** @var \App\Models\UserMaterial $material */
@endphp

<div id="comments" class="comments-area">
    <h2 class="comments-title">
        0 комментариев
    </h2>

    <ul class="comment-list">
    </ul>
</div>

<h3 class="comment-reply-title">Написать комментарий</h3>
<form class="form comment-form ec-form" method="POST" action="{{ route('material.comment', $material->slug) }}" role="form">
    @csrf
    <div class="form-group">
        <label class="control-label">Ваше имя (не обязательно)</label>
        <input type="text" name="username" class="form-control"  placeholder="Иван Юрьевич">
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
