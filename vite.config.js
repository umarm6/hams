import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/app.sass',
                'resources/js/app.js',
                'resources/images',
            ],
            refresh: true,
        }),
     ],
});
