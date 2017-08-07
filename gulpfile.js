var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--

 ------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {

    mix.sass('app.scss','resources/css')
        .styles([
            'libs/bootstrap.min.css',
            'libs/font-awesome.min.css',
            'libs/Lato.css',
            'app.css',
            'libs/select2.min.css',
            'iassets.css'
        ], 'public/css/all.css', 'resources/css')
        .scripts([
            'libs/jquery.js',
            'libs/bootstrap.min.js',
            'libs/select2.min.js',
            'iassets.js',
        ], 'public/js/all.js', 'resources/js')
        .version(
            ['public/css/all.css','public/js/all.js']
        );
//    mix.phpUnit();
    /*
     mix.styles(['vendor/normalize.css','app.css'],null,'public/css');
     mix.version(['public/css/all.css']);*/


    //mix.phpUnit().phpSpec();
    /*
     mix.sass('app.scss').coffee('module.coffee');
     mix.styles([
     'vendor/normalize.css',
     'app.css'
     ], 'public/output/final.css', 'public/css');
     mix.scripts([
     'js/module.js',
     ], 'public/output/final.js', 'public/');*/
});
