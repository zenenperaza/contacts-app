import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/css/app.css',
                'resources/img',
                'resources/js/welcome.js',
                'public/js/welcome.js',
                'public/css',
                'public/img',
                
            ],
            refresh: true,
        }),
    ],
});
