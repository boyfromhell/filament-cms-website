import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { fileURLToPath, URL } from "node:url";
import svgLoader from 'vite-svg-loader';
import vue from "@vitejs/plugin-vue";

export default defineConfig({
    plugins: [
        vue({ 
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        laravel.default({
            input: [
                // 'resources/css/app.css', 
                'resources/js/app.js',
                // 'resources/css/filament/admin/theme.css'
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            "@": fileURLToPath(new URL("./resources/js", import.meta.url)),
        },
    },
});
