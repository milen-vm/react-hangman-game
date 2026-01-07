import {
    defineConfig
} from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';

export default defineConfig({
    plugins: [
        laravel({
            input: {
                // 'resources/sass/app.scss',
                app: 'resources/js/app.jsx',
                gallery: 'resources/js/gallery.js'
            },
            refresh: true,
        }),
        react(),
    ],
    server: {
        hmr: {
            host: '192.168.56.56',
        },
        host: '192.168.56.56',
        watch: {
            usePolling: true,
        },
    },
});