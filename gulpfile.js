var
  gulp  = require('gulp'),
  growl = require('gulp-notify-growl')
;

// Initialize the notifier
var growlNotifier = growl({
  hostname : 'localhost' // IP or Hostname to notify, default to localhost
});

gulp.task('default', function() {
  gulp.src('./package.json')
  .pipe(growlNotifier({
    title: 'Done.',
    message: 'Done something with the package.json'
  }));
});