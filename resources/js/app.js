import './bootstrap';
import EasyMDE from 'easymde';
import 'easymde/dist/easymde.min.css';
import '../../public/css/estilos-crear.css';

document.addEventListener('DOMContentLoaded', () => {
    const textarea = document.getElementById('texto-usuario');
    if (textarea) {
        new EasyMDE({
            element: textarea,
            spellChecker: false,
            placeholder: "Escribe aquí . . .",
            toolbar: [
                "bold", "italic", "heading", "|",
                "quote", "unordered-list", "ordered-list", "|",
                "preview", "side-by-side", "fullscreen", "|",
                "guide"
            ]
        });
    }
});