// backup for php projects

// Port#
const PORT = '8080';

// Paths
const scssPathSource = 'php/xApps/_src/scss/*.scss';
const scssPathDestination = 'php/xApps/_assets/css';
const jsPathSource = 'php/xApps/_src/js/*.js';
const jsPathDestination = 'php/xApps/_assets/js';

// const scssPathSource = 'php/projects/xLibrary/_src/scss/*.scss';
// const scssPathDestination = 'php/projects/xLibrary/_assets/css';
// const jsPathSource = 'php/projects/xLibrary/_src/js/*.js';
// const jsPathDestination = 'php/projects/xLibrary/_assets/js';

// Imports
var gulp   = require('gulp'),
    exec   = require('child_process').exec,
    watch  = require('gulp-watch'),
    riot   = require('gulp-riot'),
    minify = require('gulp-minify'),
    sass   = require('gulp-sass'),
    plumber   = require('gulp-plumber'),
    livereload   = require('gulp-livereload'),
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


  /* Minifying + Watching Riot | JS | SCSS files */
  /*************************************/

  watch('_src/tag/*.tag', (e) => {
    gulp.src(e.path)
    .pipe(riot({
      compact: true
    }))
    .pipe(minify({
      ext: {
        min: '.min.js'
      },
      noSource: true
    }))
    .pipe(gulp.dest('_assets/tag'));
  });

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
    .pipe(sourcemaps.write('.'))
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
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest(jsPathDestination))
    .pipe(livereload());
  });

  console.log('==================================');
  console.log('Watching + Minifing a Riot | JS | SCSS files.');
  console.log('==================================');

  cb();
});

// Say hello
gulp.task('sayHello', function() {
  console.log('==================================');
  console.log("Hi, I'm always with you!");
  console.log('==================================');
});

// run -> gulp (for default tasks)
gulp.task('default', ['startWebServer', 'watch']);
