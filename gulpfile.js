var gulp = require('gulp');
var sourcemaps = require('gulp-sourcemaps');
var ts = require('gulp-typescript');
var sass = require('gulp-sass');
var minifyCSS = require('gulp-csso');

gulp.task('js', function () {
    return gulp.src('./web/**/*.ts')
        .pipe(sourcemaps.init())
        .pipe(ts({
            out: 'app.js'
        }))
        .pipe(sourcemaps.write())
        .pipe(gulp.dest('./dist/js'));
});

gulp.task('css', function () {
    return gulp.src('./web/**/*.scss')
        .pipe(sass())
        .pipe(minifyCSS())
        .pipe(gulp.dest('dist'))
});

gulp.task('build', ['js', 'css']);

gulp.task('watch', ['build'], function () {
    gulp.watch(['./web/**/*.ts'], ['js']);
    gulp.watch(['./web/**/*.scss'], ['css']);
});

gulp.task('default', ['watch']);