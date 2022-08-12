import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/pages/auth.css',
                'resources/css/pages/dashboard.css',
                'resources/css/pages/domains.css',
                'resources/css/pages/faq.css',
                'resources/css/pages/home.css',
                'resources/css/pages/pricing.css',
                'resources/css/pages/updates.css',

                'resources/scss/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});
