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
        link: {
            class: Link,
            config: {
                endpoint: window.location.href + '/url',
            }
        },
        image: {
            class: Image,
            config: {
                endpoints: {
                    byFile: window.location.href + '/upload',
                    byUrl: window.location.href + '/upload',
                },
                uploader: {
                    uploadByFile(file){
                        const formData = new FormData();
                        formData.append("image", file);
                        // your own uploading logic here
                        return axios.post(window.location.href + '/upload', formData, {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            }
                        }).then(response => {
                            return response.data;
                        });
                    },
                }
            }
        }
    },
})


$('#editorjs-save').click(async function () {
    const data = await editor.save();

    const response = await axios.post(window.location.href + '/update', {
        data: data
    });

    if (response.data.status) {
        successNoty(response.data.message)
    } else {
        errorNoty(response.data.message)
    }

})
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
