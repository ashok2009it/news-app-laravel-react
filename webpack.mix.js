const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
   .react() // Ensure this line is present to handle React syntax
   .sass('resources/sass/app.scss', 'public/css');
