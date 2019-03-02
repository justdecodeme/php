// backup for php projects
// Port#
const PORT = '8080';

const scssPathSource = 'php/x-apps/_src/scss/*.scss';
const scssPathDestination = 'php/x-apps/_assets/css';
const jsPathSource = 'php/x-apps/_src/js/*.js';
const jsPathDestination = 'php/x-apps/_assets/js';
const mapPathDestination = '../../maps'; // this path is related to *.min.js/*.min.css files

// Imports
var gulp = require('gulp'),
  exec = require('child_process').exec,
  watch = require('gulp-watch'),
  minify = require('gulp-minify'),
  sass = require('gulp-sass'),
  plumber = require('gulp-plumber'),
  livereload = require('gulp-livereload'),
  rename = require('gulp-rename'),
  sourcemaps = require('gulp-sourcemaps');

// Start localhost
gulp.task('startWebServer', (cb) => {
  var root = process.cwd();
  exec('c:\\xampp\\php\\php.exe -S localhost:' + PORT + ' -t ' + root, (err, stdout, stderr) => {
    if (err) {
      return cb(err);
    }
  });
  console.log('==================================');
  console.log('The web server has started. PORT: ' + PORT);
  console.log('==================================');
  cb();
});

// Stop localhost
gulp.task('stopWebServer', (cb) => {
  exec('FOR /F "tokens=5 delims= " %P IN (\'netstat -ano ^| findstr :' + PORT + ' ^| findstr /i LISTENING\') DO TaskKill.exe /F /PID %P', (err, stdout, stderr) => {
    if (err) {
      return cb(err);
    }
  });
  console.log('==================================');
  console.log('The web server has stopped.');
  console.log('==================================');
  cb();
});

// Watchers
gulp.task('watch', (cb) => {
  livereload.listen();

  /* Watching HTML | PHP| CSS | JS | JSON files for any changes */
  /*******************************************************/

  watch('./**/*.html', (e) => {
    gulp.src(e.path)
      .pipe(plumber())
      .pipe(livereload());
  });

  watch('./**/*.php', (e) => {
    gulp.src(e.path)
      .pipe(plumber())
      .pipe(livereload());
  });

  watch('./**/*.css', (e) => {
    gulp.src(e.path)
      .pipe(plumber())
      .pipe(livereload());
  });

  watch('./**/*.js', (e) => {
    gulp.src(e.path)
      .pipe(plumber())
      .pipe(livereload());
  });

  watch('./**/*.json', (e) => {
    gulp.src(e.path)
      .pipe(plumber())
      .pipe(livereload());
  });

  console.log('==================================');
  console.log('Watching your HTML | PHP | CSS | JS | JSON files.');
  console.log('==================================');


  /* Minifying + Watching SCSS | JS files */
  /*************************************/

  watch(scssPathSource, (e) => {
    gulp.src(e.path)
      .pipe(plumber())
      .pipe(sourcemaps.init())
      .pipe(sass({
        outputStyle: 'compressed'
      }).on('error', sass.logError))
      .pipe(rename({
        suffix: ".min"
      }))
      .pipe(sourcemaps.write(mapPathDestination))
      .pipe(gulp.dest(scssPathDestination))
      .pipe(livereload());
  });

  watch(jsPathSource, (e) => {
    gulp.src(e.path)
      .pipe(plumber())
      .pipe(sourcemaps.init())
      .pipe(minify({
        ext: {
          min: '.min.js'
        },
        noSource: true
      }))
      .pipe(sourcemaps.write(mapPathDestination))
      .pipe(gulp.dest(jsPathDestination))
      .pipe(livereload());
  });

  console.log('==================================');
  console.log('Watching + Minifing a SCSS | JS files.');
  console.log('==================================');

  cb();
});

// Say hello
gulp.task('sayHello', function () {
  console.log('==================================');
  console.log("Hi, I'm always with you!");
  console.log('==================================');
});

// run -> gulp (for default tasks)
gulp.task('default', ['startWebServer', 'watch']);