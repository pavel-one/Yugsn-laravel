import autoComplete from "@tarekraafat/autocomplete.js"
import axios from 'axios';

require('./bootstrap');

const autoCompleteJS = new autoComplete({
    placeHolder: "Поиск материала",
    selector: "#search",
    data: {
        src: async () => {
            // Fetch Data from external Source
            const data = await axios.post('/search/api/', {
                query: $('#search').val(),
            });

            // Returns Fetched data
            return data;
        },
        key: ['title'],
        cache: true
    },
    resultItem: {
        highlight: {
            render: true
        }
    }
});

