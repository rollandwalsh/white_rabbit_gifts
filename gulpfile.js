'use strict';

var Fiber = require('fibers');
var gulp = require('gulp');
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');
var autoprefixer = require('gulp-autoprefixer');

sass.compiler = require('sass');

gulp.task('sass', function () {
	return gulp.src('./sass/**/*.scss')
		.pipe(sourcemaps.init())
		.pipe(sass({
			fiber: Fiber,
			outputStyle: 'expanded'
		}).on('error', sass.logError))
		.pipe(sourcemaps.write())
		.pipe(gulp.dest('./'));
});

gulp.task('watch', function () {
	gulp.watch('./sass/**/*.scss', gulp.series('sass'));
});

function sass() {
	return gulp.src('./sass/**/*.scss')
		.pipe(sourcemaps.init())
		.pipe(sass({
			fiber: Fiber,
			outputStyle: 'expanded'
		}).on('error', sass.logError))
		.pipe(sourcemaps.write())
		.pipe(autoprefixer({
			browsers: ["last 2 versions", "ie >= 9", "ios >= 7"]
		}))
		.pipe(gulp.dest('./'));
}

function watch() {
	gulp.watch('./sass/**/*.scss', ['sass']);
}