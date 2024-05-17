import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/create_tarjeta.js',
                'resources/js/create_metas_ahorro.js',
                'resources/js/edit_metas_ahorro.js',
                'resources/js/show_ahorros.js',
                'resources/js/inicio.js',
            ],
            refresh: true,
        }),
    ],
});
