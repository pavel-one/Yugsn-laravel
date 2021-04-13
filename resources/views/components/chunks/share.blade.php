<div class="saxon-social-share-fixed sidebar-position-right">
    <div class="post-social-wrapper">
        <div class="post-social-title">Поделиться:</div>
        <div class="post-social">
            <a title="Поделиться через Вконтакте"
               href="{{ $material->getLink() }}" data-type="vk"
               data-title="{{ $material->title }}"
               class="vk-share"> <i class="fa fa-vk"></i>
            </a>
            <a title="Поделиться через Facebook"
               href="{{ $material->getLink() }}" data-type="fb"
               data-title="{{ $material->title }}"
               class="facebook-share"> <i class="fa fa-facebook"></i>
            </a>
            <a title="Поделиться через Twitter"
               href="{{ $material->getLink() }}" data-type="twitter"
               data-title="{{ $material->title }}"
               class="twitter-share"> <i class="fa fa-twitter"></i>
            </a>
            <a title="Поделиться через LinkedIn"
               href="{{ $material->getLink() }}" data-type="linkedin"
               data-title="{{ $material->title }}"
               class="linkedin-share"> <i class="fa fa-linkedin"></i>
            </a>
        </div>
        <div class="clear"></div>
    </div>
</div>
