import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    const input = document.getElementById('cover');
    const preview = document.getElementById('coverPreview');

    if (input && preview) {
        input.addEventListener('change', event => {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = e => {
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    }
});
