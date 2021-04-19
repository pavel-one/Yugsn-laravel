@php
    /** @var \App\Models\Comment $comment */
@endphp

<div class="comment-wrapper">
    <div class="comment-top">
        <div class="name">
            {{ $comment->username ?? 'Анонимно' }}
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
                    <i class="fa fa-reply" aria-hidden="true"></i>
                </div>
                <div>
                    Ответить
                </div>
            </a>
        </div>
    </div>
</div>
