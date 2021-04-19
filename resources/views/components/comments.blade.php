@php
    /** @var \App\Models\Comment[] $comments */
@endphp

@foreach($comments as $comment)
    <div class="comment-item">
        @include('components.chunks.material.comment', ['comment' => $comment])

        @if($comment->children()->count() > 0)
            <div class="comment-children">
                @include('components.comments', ['comments' => $comment->children])
            </div>
        @endif
    </div>

@endforeach
