<div class="container saxon-subscribe-block-container saxon-block" data-aos="fade-up">
    <div class="saxon-subscribe-block">
        <div class="row">
            <div class="col-md-12">
                <h5><strong>Подпишитесь на нашу рассылку <br class="br"/>и будьте в курсе</strong></h5>
                <form class="mc4wp-form subscribe-form" method="post" action="{{ route('subscribe.add') }}">
                    @csrf
                    <div class="mc4wp-form-fields">
                        <div class="mailchimp-widget-signup-form">
                            <input type="email" name="email" placeholder="Введите Ваш e-mail" required/>
                            <button type="submit" class="btn">
                                Подписка
                            </button>
                        </div>
                    </div>
                    <div class="errors"></div>
                </form>
            </div>
        </div>
    </div>
</div>
