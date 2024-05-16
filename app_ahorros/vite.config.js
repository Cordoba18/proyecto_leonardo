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
            ],
            refresh: true,
        }),
    ],
});