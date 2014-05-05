var
gulp  = require('gulp')
, minifyCSS = require('gulp-minify-css')
, concat = require('gulp-concat')
, uglify  = require('gulp-uglify')


gulp.task('manage-css', function() {
	return gulp.src([
		"public/bower/bootstrap/dist/css/bootstrap.min.css",
		"public/_frontend/assets/css/style.css",
		"public/assets/css/bootstrap-editable.css",
		"public/assets/css/manage.css",
		"public/bower/tag-it/css/jquery.tagit.css"
		])
	.pipe(minifyCSS())
	.pipe(concat("all.css"))
	.pipe(gulp.dest('public/assets/'));
});



// Handle Javascript compilation
gulp.task('manage-js', function () {
	return gulp.src([
		"public/bower/jquery/dist/jquery.min.js",
		"public/bower/bootstrap/dist/js/bootstrap.min.js",
		"public/bower/hammer.js/index.js",
		"public/assets/js/manage.js",
		"public/bower/jquery.hammer.js/index.js",
		"public/assets/js/dropzone.js",
		"public/bower/app-folders/index.js",
		"public/bower/tag-it/js/tag-it.min.js",
		"public/bower/underscore/underscore.js"
		]) .pipe(uglify())
	.pipe(concat('all.js'))
	.pipe(gulp.dest('public/assets/'));
});

gulp.task('watch', function () {
    gulp.watch(sassDir + '/**/*.sass', ['manage-css']);
    gulp.watch(coffeeDir + '/**/*.coffee', ['manage-js']);
    gulp.watch('app/**/*.php', ['phpunit']);
});

gulp.task('default', ['manage-css', 'manage-js', 'watch']);
