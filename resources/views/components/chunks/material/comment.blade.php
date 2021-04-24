@php
    /** @var \App\Models\Comment $comment */
    /** @var \App\Models\UserMaterial $material */
@endphp

<div class="comment-wrapper aos-init aos-animate" data-aos="fade-up">
    <div class="comment-top">
        <div class="name">
            {{ $comment->username ?? 'Анонимно' }}
            @if($comment->user && ($material->user_id === $comment->user->id))
                <span class="badge badge-primary">Автор</span>
            @endif
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
            <a href="#" class="action-item reply" data-id="{{ $comment->id }}">
                <div class="icon">
                    <i class="fa fa-reply" aria-hidden="true"></i>
                </div>
                <div>
                    Ответить
                </div>
            </a>
        </div>
    </div>
</div>
