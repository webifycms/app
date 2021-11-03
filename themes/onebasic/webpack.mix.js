const mix = require('laravel-mix')

mix.js("assets/js/app.js", "js")
    .postCss("assets/css/app.css", "css", [
        require("tailwindcss"),
    ])
    .options({
        processCssUrls: false
    })
    .setPublicPath('dist')
    .browserSync({
        files: [
            './assets/**/*.js',
            './assets/**/*.css',
            './templates/admin/**/*.php',
            './templates/**/*.php',
        ],
        proxy: 'getonecms.test/app/public/'
    })