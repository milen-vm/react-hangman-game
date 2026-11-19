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
                laravel: 'resources/css/laravel.css',
                app: 'resources/js/app.jsx',
                gallery: 'resources/js/gallery.js',
                datetimepicker: 'resources/js/datetime-picker/bootstrap-datetimepicker.min.js',
                datetimepickerBg: 'resources/js/datetime-picker/bootstrap-datetimepicker.bg.js',
                datetimepickerCss: 'resources/css/datetime-picker/bootstrap-datetimepicker.min.css'
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