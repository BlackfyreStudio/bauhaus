var gulp   = require('gulp'),
	watch  = require('gulp-watch'),
	sass   = require('gulp-sass'),
	uglify = require('gulp-uglifyjs'),
	concat = require('gulp-concat'),
	rename = require('gulp-rename');

var paths = {
	stylesheets: [
		'assets/stylesheets/**/*.scss'
	],
	javascripts: [

		'bower_components/jquery/dist/jquery.js',
        'bower_components/markdown/lib/markdown.js',
        'bower_components/momentjs/min/moment-with-locales.js',
		'bower_components/bootstrap/dist/js/bootstrap.js',
		'bower_components/bootstrap-datetimepicker/src/js/bootstrap-datetimepicker.js',
		'bower_components/to-markdown/src/to-markdown.js',
		'bower_components/bootstrap-markdown/js/bootstrap-markdown.js',
		'bower_components/tinymce/tinymce.js',
		'assets/javascripts/**/*.js'
	],
    fonts: [
        'bower_components/bootstrap-sass-official/vendor/assets/fonts/bootstrap/**.*',
        'bower_components/font-awesome/fonts/**.*',
        'assets/fonts/**.*'
    ]
};

gulp.task('sass', function() {
	return gulp.src(paths.stylesheets)
		.pipe(sass())
		.pipe(gulp.dest('public/stylesheets'));
});

gulp.task('uglify', function () {
	return gulp.src(paths.javascripts)
        .pipe(concat('application.min.js'))
		.pipe(uglify({
			mangle: false
		}))
		.pipe(gulp.dest('public/javascripts'));
});

gulp.task('fonts', function() {
    gulp.src(paths.fonts).pipe(gulp.dest('public/fonts'));
});

gulp.task('watch', function () {
	gulp.watch(paths.stylesheets, ['sass']);
	gulp.watch(paths.javascripts, ['uglify']);
});
