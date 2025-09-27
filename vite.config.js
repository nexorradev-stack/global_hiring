import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
    build: {
        outDir: 'public/build',   // output folder inside public
        emptyOutDir: true,        // clean folder before building
        rollupOptions: {
            input: {
                app: path.resolve(__dirname, 'resources/js/app.js'),
                style: path.resolve(__dirname, 'resources/css/app.css')
            },
        },
    },
});
