const gulp        = require('gulp');
const browserSync = require('browser-sync').create();
const sass        = require('gulp-sass');
const uglify = require("gulp-uglify");
const cleanCSS = require('gulp-clean-css');
const htmlmin = require('gulp-htmlmin');

const buffer = require("vinyl-buffer");
//const pipeline      = require('readable-stream').pipeline;


///complie sass into css & auto-inject into browser

function style(){
    // Add destination of the Sass file 
    return gulp.src(['./src/scss/**/*.scss','node_modules/bootstrap/scss/bootstrap.scss'])
    // Add scss file to complier
    .pipe(sass())

    // Minify the CSS using Clean CSS
    .pipe(cleanCSS({compatibility: 'ie8'}))

    // saving the complied file at destination
    .pipe(gulp.dest('./src/css'))
}

function jsmini(){

    return gulp.src(['node_modules/jquery/dist/jquery.min.js','node_modules/popper.js/dist/popper.min.js','node_modules/bootstrap/dist/js/bootstrap.min.js'])
    
    // adding vinyl buffer 
   
    .pipe(gulp.dest('./src/js'))


}


function minihtml(){
    return gulp.src('./src/*.html')
    .pipe(htmlmin({ collapseWhitespace: true }))
    .pipe(gulp.dest('dist'));
}

exports.minihtml =minihtml;



exports.jsmini= jsmini;

exports.style = style;


function watch(){
     browserSync.init({
        watch: true,
        server: "./src",
        browser: "chrome"
       
       
     });

     gulp.watch('./src/scss/**/*.scss',style);
     gulp.watch('node_modules/bootstrap/scss/bootstrap.scss',style);
     gulp.watch('./src/*html').on('change',browserSync.reload);
     gulp.watch('./src/js/*.js').on('change',browserSync.reload);

    }

    exports.watch = watch;








