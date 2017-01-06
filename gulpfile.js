var gulp = require('gulp');
var concat = require('gulp-concat');
var rename = require('gulp-rename');
var uglify = require('gulp-uglify');

//script paths
var jsFiles = 'assets/**/*.js',
    jsDest = 'dist/scripts';

gulp.task('default', ['scripts']);

gulp.task('scripts', function() {
    return gulp.src(jsFiles)
        .pipe(concat('maps.js'))
        .pipe(gulp.dest(jsDest))
        .pipe(rename('maps.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest(jsDest));
});