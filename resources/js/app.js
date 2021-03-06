import autoComplete from "@tarekraafat/autocomplete.js"
import axios from 'axios';
import Slick from 'slick-carousel'

require('./bootstrap');

const autoCompleteJS = new autoComplete({
    placeHolder: "Поиск материала",
    selector: "#search",
    data: {
        src: async () => {
            const data = await axios.post('/search/api/', {
                query: $('#search').val(),
            });

            return data.data;
        },
        key: ['id', 'title'],
    },
    resultItem: {
        highlight: {
            render: true
        }
    },
    onSelection: (feedback) => {
        window.location.href = window.location.origin + '/' + feedback.selection.value.slug;
    },
    trigger: {
        event: ["keyup"],
        condition: (event, queryValue) => {
            if (event.keyCode === 13) {
                window.location.href = window.location.origin + '/search/?query=' + encodeURI(queryValue)
                return false;
            }
            return queryValue;
        }
    },
    resultsList: {
        noResults: (list, query) => {
            const message = document.createElement("li");
            message.setAttribute("class", "no_result");
            message.setAttribute("tabindex", "1");
            message.innerHTML = `<span style="display: flex; align-items: center; margin-left: 10px; font-weight: 100; color: #000;">Ничего не найдено "${query}"</span>`;
            list.appendChild(message);
        },

    },
});

Noty.overrideDefaults({
    type: 'success',
    layout   : 'topRight',
    theme    : 'metroui',
    animation: {
        open : 'animate__animated animate__fadeInDown',
        close: 'animate__animated animate__fadeOutDown'
    }
});

$('.subscribe-form').submit(function (e) {
    const url = $(this).attr('action');
    axios.post(url, $(this).serialize())
        .then(response => {
            successNoty('Вы успешно подписались')
            $(this).fadeOut();
        })
        .catch(error => {
            errorNoty('Ошибка заполнения формы')
            addErrors(this, error.response.data)
        })
    return false;
})

$(document).on('submit', '.comment-form', function (e) {
    const url = $(this).attr('action');
    axios.post(url, $(this).serialize())
        .then(response => {
            if (!response.data.status) {
                errorNoty(response.data.message);
            } else {
                successNoty(response.data.message)
                $(this).fadeOut();
            }
        })
        .catch(error => {
            errorNoty('Ошибка заполнения формы')
            addErrorsWithFields(this, error.response.data.errors)
        })
    return false;
})

$('.reply').click(function (e) {
    const parent = $(this).closest('.comment-wrapper');
    const id = $(this).data('id');
    $('.reply-form').clone().appendTo(parent).fadeIn();
    $(this).closest('.comment-wrapper').find('[name=parent]').val(id)
    return false;
})

$('.content-slider').slick({
    // slidesToShow: 3,
    // slidesToScroll: 1,
    dots: true,
    prevArrow: '<div class="arrow prev"><i class="fa fa-angle-left" aria-hidden="true"></i></div>',
    nextArrow: '<div class="arrow next"><i class="fa fa-angle-right" aria-hidden="true"></i></div>'
});

function addErrors(form, errors) {
    const errorBlock = $(form).find('.errors');
    errorBlock.html('<ul></ul>');
    for (let key in errors.errors) {
        errorBlock.find('ul').append(errors.errors[key][0])
    }
}

function addErrorsWithFields(form, errors) {
    for (let key in errors) {
        $(form).find('#field-'+key).text(errors[key][0]);
    }
}

function successNoty(text) {
    return new Noty({
        text: text,
        timeout: 3500,
        progressBar: true,
        type: 'success'
    }).show();
}

function errorNoty(text) {
    return new Noty({
        text: text,
        timeout: 5000,
        progressBar: true,
        type: 'error'
    }).show();
}

