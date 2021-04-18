import autoComplete from "@tarekraafat/autocomplete.js"
import axios from 'axios';

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
        .then(reponse => {
            successNoty('Вы успешно подписались')
            $(this).fadeOut();
        })
        .catch(error => {
            errorNoty('Ошибка заполнения формы')
            addErrors(this, error.response.data)
        })
    return false;
})


function addErrors(form, errors) {
    const errorBlock = $(form).find('.errors');
    errorBlock.html('<ul></ul>');
    for (let key in errors.errors) {
        errorBlock.find('ul').append(errors.errors[key][0])
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

