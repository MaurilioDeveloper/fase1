/**
 * 
 * @type laravel-elixir
 * Biblioteca do Laravel responsavel por 
 * gerenciar o front-end.
 * Além de trabalhar com diversos tipos de 
 * styles e scripts, ainda possui o versionamento do
 * codigo Javascript. Ele não deixa o cache da aplicaçao,
 * assim, ao ser modificado um script, automaticamente ele será
 * versionado.
 */
   var elixir = require('laravel-elixir'),
    liveReload = require('gulp-livereload'),
    clean = require('rimraf'),
    gulp = require('gulp');

/**
 * @type assets_path
 * Responsavel por retornar o caminho da pasta de 'assets'.
 * @type build_path
 * Responsavel por retornar o caminho da pasta da 'build'
 */
    var config = {
        assets_path: './resources/assets',
        build_path: './public/build'
    };

/**
 * @typer bower_path
 * Responsavel por buscar o caminho da pasta 'bower_componentes',
 * atraves do 'assets_path', voltando uma pasta e posteriormente,
 * sendo ecaminhado para pasta das dependencias.
 */
config.bower_path = config.assets_path + '/../bower_components';

/**
 * @type build_path_js
 * Responsavel por buscar o caminho da pasta 'js', que está dentro
 * de 'public/build'. Armazenando aonde ficara os 'javascripts' no
 * 'build_path_js'.
 */
config.build_path_js = config.build_path + '/js';

/**
 * @type build_vendor_path
 * Define aonde ficará os 'javascript' de terceiros na aplicaçao.
 */
config.build_vendor_path_js = config.build_path_js + '/vendor';

/**
 * @type vendor_path_js
 * Responsavel por definir de onde virá todos os 'javascripts' de terceiros
 */
config.vendor_path_js = [
    config.bower_path + '/jquery/dist/jquery.min.js',
    config.bower_path + '/bootstrap/dist/js/bootstrap.min.js',
    config.bower_path + '/angular/angular.min.js',
    config.bower_path + '/angular-animate/angular-animate.min.js',
    config.bower_path + '/angular-aria/angular-aria.min.js',
    config.bower_path + '/angular-messages/angular-messages.min.js',
    config.bower_path + '/angular-material/angular-material.min.js',
    config.bower_path + '/angular-route/angular-route.min.js',
    config.bower_path + '/angular-resource/angular-resource.min.js'
];

config.build_path_css = config.build_path + '/css';

/**
 * @type build_vendor_path
 * Define aonde ficará os 'javascript' de terceiros na aplicaçao.
 */
config.build_vendor_path_css = config.build_path_css + '/vendor';
/**
 * @type vendor_path_css
 * Responsavel por definir de onde virá todos os 'css' de terceiros
 */
config.vendor_path_css = [
    config.bower_path + '/bootstrap/dist/css/bootstrap.min.css',
    config.bower_path + '/bootstrap/dist/css/bootstrap-theme.min.css'
];


//config.build_path_html = config.build_path + '/views';
config.build_path_fonts = config.build_path + '/fonts';
config.build_path_images = config.build_path + '/images';

/*
gulp.task('copy-html', function(){
    gulp.src([
            config.assets_path + '/js/views/**//*.html'
        ])
        .pipe(gulp.dest(config.build_path_html))
        .pipe(liveReload());
});
*/

gulp.task('copy-fonts', function(){
    gulp.src([
            config.assets_path + '/fonts/**/*'
        ])
        .pipe(gulp.dest(config.build_path_fonts))
        .pipe(liveReload());
});

gulp.task('copy-images', function(){
    gulp.src([
            config.assets_path + '/images/**/*'
        ])
        .pipe(gulp.dest(config.build_path_images))
        .pipe(liveReload());
});

gulp.task('copy-styles', function(){
    gulp.src([
        config.assets_path + '/css/**/*.css'
    ])
        .pipe(gulp.dest(config.build_path_css))
        .pipe(liveReload());

    gulp.src(config.vendor_path_css)
        .pipe(gulp.dest(config.build_vendor_path_css))
        .pipe(liveReload());
});

gulp.task('copy-scripts', function(){
    gulp.src([
            config.assets_path + '/js/**/*.js'
        ])
        .pipe(gulp.dest(config.build_path_js))
        .pipe(liveReload());


    gulp.src(config.vendor_path_js)
        .pipe(gulp.dest(config.build_vendor_path_js))
        .pipe(liveReload());
});


/**
 * @clean-build-folder
 * Tarefa Responsavel por limpar as pastas com os arquivos.
 */
gulp.task('clear-build-folder', function(){
    clean.sync(config.build_path);
});

/**
 * @default
 * Tarefa Padrão, responsavel por ser executada em modo Produção,
 * pois compacta todos os Styles e Scripts e gera dois arquivos com todo
 * o conteudo dentro. 'all.css', 'all.js'.
 */
gulp.task('default', ['clear-build-folder'], function(){
    gulp.start('copy-fonts', 'copy-images');
    elixir(function(mix){
        mix.styles(config.vendor_path_css.concat([config.assets_path + '/css/**/*.css']),
        'public/css/all.css', config.assets_path);
        mix.scripts(config.vendor_path_js.concat([config.assets_path + '/js/**/*.js']),
            'public/js/all.js', config.assets_path);
        mix.version(['js/all.js','css/all.css']);
    });
});


/**
 * @watch-dev
 * Tarefa Responsavel por copiar todos os arquivos de Styles e Scripts
 * e jogar para pasta 'public'. (Tarefa Executada em modo Desenvolvimento).
 */
gulp.task('watch-dev',['clear-build-folder'], function(){
    liveReload.listen();
    gulp.start('copy-styles', 'copy-scripts', 'copy-fonts', 'copy-images');
    gulp.watch(config.assets_path + '/**', ['copy-styles','copy-scripts', 'copy-fonts', 'copy-images']);
});
