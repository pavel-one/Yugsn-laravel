$(document).ready(function () {
    $('.form_ajax_go').submit(function () {
        let th = $(this);
        $.ajax({
            type: "POST",
            url: "mail.php",
            data: th.serialize(),
            beforeSend: function () {
                //th.prop('disabled', true);
                //th.find('input,textarea').prop('disabled', true);
                th.append(
                    '<div id="form_loader" style="position: absolute;z-index: 999;display: flex;flex-direction: column;justify-content: center;text-align: center;width: 100%;height: 100%;background: rgba(0,0,0,.15);left: 0;top: 0;">' +
                    '<img src="/preloader.svg" alt="">' +
                    '</div>'
                );
            },
            success: function () {
                th.trigger("reset");
                $.fancybox.open(
                    '<div class="message" style="text-align:center">' +
                    '<h2>Спасибо!</h2>' +
                    '<p>Мы обязательно отреагируем на вашу заявку.</p>' +
                    '</div>'
                );
                $('#form_loader').remove();
                setTimeout(function () {
                    $.fancybox.close();
                    $.fancybox.close();
                }, 3000);
            }
        });
        return false;
    });

    let masonryContainer = $('.blog-layout-masonry');
    if (masonryContainer.length) {
        masonryInit(masonryContainer);
        $(document).on('pdopage_load', function () {
            masonryInit(masonryContainer, true);
        });
    }
    function masonryInit(container, reInit=false) {
        if (reInit) {
            container.masonry('destroy');
            setTimeout(function () {
                container.masonry({
                    itemSelector: '.masonry-pavel',
                    singleMode: true,
                    isResizable: true,
                    isAnimated: true,
                    animationOptions: {
                        queue: false,
                        duration: 500
                    }
                });
            }, 500);
            return;
        }
        container.masonry({
            itemSelector: '.masonry-pavel',
            singleMode: true,
            isResizable: true,
            isAnimated: true,
            animationOptions: {
                queue: false,
                duration: 500
            }
        });
    }

    $('[data-url]').click(function() {
        window.location.href = $(this).data('url');
    });
});