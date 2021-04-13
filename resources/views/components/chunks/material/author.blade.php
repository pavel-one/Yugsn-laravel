@php
    /** @var \App\Models\User $user */
    /** @var \App\Models\UserMaterial $material */
    $user = $material->user;
@endphp

<div class="author-bio aos-init aos-animate" data-aos="fade-up">
    <div class="author-image">
        <a href="{{ $user->getLink() }}">
            <img src="https://www.gravatar.com/avatar/c2a482ace9da936b9c4c7e6c0afc74c9?s=170&amp;d=mm" class="avatar avatar-post photo">
        </a>
    </div>
    <div class="author-info">
        <h5>Об авторе</h5>
        <h3>
            <a href="{{ $user->getLink() }}" title="{{ $user->getAuthorName() }}" rel="author">
                {{ $user->getAuthorName() }}
            </a>
        </h3>
        <div class="author-description">
            test
        </div>

    </div>
    <div class="clear"></div>
</div>
