import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { viteStaticCopy } from 'vite-plugin-static-copy';

export default defineConfig({
    build: {
        manifest: true,
        rtl: true,
        outDir: 'public/build/',
        cssCodeSplit: true,
        rollupOptions: {
            output: {
                assetFileNames: (css) => {
                    if (css.name.split('.').pop() == 'css') {
                        return 'css/' + `[name]` + '.min.' + 'css';
                    } else {
                        return 'icons/' + css.name;
                    }
                },
                entryFileNames: 'js/' + `[name]` + `.js`,
            },
        },
    },
    plugins: [
        laravel({
            input: ['resources/css/style.css', 'resources/js/script.js'],
            refresh: true,
        }),

        viteStaticCopy({
            targets: [
                {
                    src: 'resources/css', // Stellen sicher, dass Dateien vorhanden sind
                    dest: ''
                },
                {
                    src: 'resources/fonts', // Stellen sicher, dass Dateien vorhanden sind
                    dest: ''
                },
                {
                    src: 'resources/img', // Stellen sicher, dass Dateien vorhanden sind
                    dest: ''
                },
                {
                    src: 'resources/js', // Stellen sicher, dass Dateien vorhanden sind
                    dest: ''
                },
                {
                    src: 'resources/plugins', // Stellen sicher, dass Dateien vorhanden sind
                    dest: ''
                },
                {
                    src: 'resources/scss', // Stellen sicher, dass Dateien vorhanden sind
                    dest: ''
                },
            ]
        }),
    ],
});