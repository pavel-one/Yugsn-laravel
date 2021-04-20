import EditorJS from '@editorjs/editorjs';
import Header from '@editorjs/header';
import List from '@editorjs/list';
import Image from '@editorjs/image'
import Link from '@editorjs/link'
import Quote from '@editorjs/quote'

const editor = new EditorJS({
    /**
     * Id of Element that should contain the Editor
     */
    holder: 'editorjs',

    /**
     * Available Tools list.
     * Pass Tool's class or Settings object for each Tool you want to use
     */
    tools: {
        header: Header,
        list: List,
        quote: Quote,
        image: Image,
        link: Link
    },
})
