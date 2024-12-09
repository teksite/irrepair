import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
     build: {
         outDir:"public_html/build",
    //     /*  assetsDir:"minified",
    //
    //       minify: 'terser',
    //       terserOptions: {
    //           compress: {
    //               defaults:false,
    //           },
    //           toplevel:true,
    //           keep_fnames:true,
    //           keep_classnames:true,
    //       },
    //       rollupOptions:{
    //           treeshake:false
    //       }*!/
    //       */
     },

    plugins: [
        laravel({
            input: [
                // 'Modules/Main/resources/assets/js/daynightmode.js',
                // 'Modules/Widget/resources/assets/js/client.js',

               'Modules/Main/resources/assets/css/admin.css', 'Modules/Main/resources/assets/js/admin.js',
               'Modules/Main/resources/assets/css/panel.css', 'Modules/Main/resources/assets/js/panel.js',

                'resources/css/app.css', 'resources/js/app.js', 'resources/font/font.css',
                'Modules/Captcha/resources/assets/js/app.js',


                'Modules/Menu/resources/assets/css/app.css', 'Modules/Menu/resources/assets/js/app.js',
                'Modules/Blog/resources/assets/css/app.css', 'Modules/Blog/resources/assets/js/app.js',

            ],
             publicDirectory: 'public_html',
            refresh: true,
        }),
    ],
    // server: {
    //     hmr: {
    //         host: 'localhost',
    //     },
    // },
});
