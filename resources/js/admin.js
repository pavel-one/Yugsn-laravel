import EditorJS from '@editorjs/editorjs';
import Header from '@editorjs/header';
import List from '@editorjs/list';
import Image from '@editorjs/image'
import Link from '@editorjs/link'
import Quote from '@editorjs/quote'
import axios from "axios";

const editor = new EditorJS({
    holder: 'editorjs',
    data: $('#editorjs').data('json'),
    tools: {
        header: Header,
        list: List,
        quote: Quote,
        image: Image,
        link: {
            class: Link,
            config: {
                endpoint: window.location.href + '/url',
            }
        }
    },
})


$('#editorjs-save').click(async function () {
    const data = await editor.save();

    const response = await axios.post(window.location.href + '/update', {
        data: data
    });


})
