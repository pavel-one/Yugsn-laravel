@php
    /** @var \App\Models\UserMaterial $material */
    /** @var \App\Models\Comment[] $comments */
@endphp

<h3 class="comment-reply-title">Написать комментарий</h3>
<form class="form comment-form ec-form" id="#comments" method="POST" action="{{ route('material.comment', $material->slug) }}"
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
        @foreach($comments as $comment)
            <div class="comment-item">
                <div class="comment-wrapper">
                    <div class="comment-top">
                        <div class="name">
                            {{ $comment->username ?? 'Без имени' }}
                        </div>
                    </div>
                    <div class="comment-middle text">
                        {{ $comment->text }}
                    </div>
                    <div class="comment-bottom">
                        <div class="date">
                            {{ $comment->created_at->diffForHumans() }}
                        </div>
                        <div class="actions">
                            <a href="#" class="action-item">
                                <div class="icon">
                                    <i class="fas fa-reply"></i>
                                </div>
                                <div>
                                    Ответить
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

