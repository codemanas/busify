const gulp = require('gulp');
const babel = require('gulp-babel');
const concat = require('gulp-concat');
const uglify = require('gulp-uglify');
const rename = require('gulp-rename');
const cleanCSS = require('gulp-clean-css');
const sourcemaps = require('gulp-sourcemaps');
const sass = require('gulp-sass');
const autoprefixer = require('autoprefixer');
const postcss = require('gulp-postcss');
const merge = require("merge-stream");
const del = require('del');

const paths = {
    styles: {
        src: 'src/styles/**/*.scss',
        dest: 'assets/styles/'
    },
    scripts: {
        src: 'src/scripts/**/*.js',
        dest: 'assets/scripts/'
    }
};

/* Not all tasks need to use streams, a gulpfile is just another node program
 * and you can use all packages available on npm, but it must return either a
 * Promise, a Stream or take a callback and call it
 */
function clean() {
    // You can use multiple globbing patterns as you would with `gulp.src`,
    // for example if you are using del 2.0 or above, return its promise
    return del(['assets/scripts', 'assets/styles']);
}


// Bring third party dependencies from node_modules into vendor directory
function modules() {
    return merge();
}

/*
 * Define our tasks using plain functions
 */
function styles() {
    return gulp.src(paths.styles.src)
        .pipe(sourcemaps.init())
        .pipe(sass({
            errLogToConsole: true,
            outputStyle: 'compact',
            precision: 10
        }))
        .pipe(postcss([autoprefixer]))
        .pipe(gulp.dest(paths.styles.dest))
        .pipe(cleanCSS({
            level: {
                1: {
                    cleanupCharsets: true,
                    removeEmpty: true,
                    removeWhitespace: true,
                    specialComments: 0
                }
            }
        }))
        // pass in options to the stream
        .pipe(rename({
            basename: 'main',
            suffix: '.min'
        }))
        .pipe(sourcemaps.write('./maps'))
        .pipe(gulp.dest(paths.styles.dest));
}

function scripts() {
    return gulp.src(paths.scripts.src, {sourcemaps: true})
        .pipe(babel())
        .pipe(uglify())
        .pipe(gulp.dest(paths.scripts.dest))
        .pipe(concat('main.min.js'))
        .pipe(gulp.dest(paths.scripts.dest));
}

function watchFiles() {
    gulp.watch(paths.scripts.src, scripts);
    gulp.watch(paths.styles.src, styles);
}

/*
 * Specify if tasks run in series or parallel using `gulp.series` and `gulp.parallel`
 */
const build = gulp.series(clean, gulp.parallel(styles, scripts));
// const build = gulp.series(modules, gulp.parallel(styles, scripts));
const watch = gulp.series(build, gulp.parallel(watchFiles));

/*
 * You can use CommonJS `exports` module notation to declare tasks
 */
exports.clean = clean;
exports.styles = styles;
exports.scripts = scripts;
exports.watch = watch;
exports.build = build;
/*
 * Define default task that can be called by just running `gulp` from cli
 */
exports.default = build;