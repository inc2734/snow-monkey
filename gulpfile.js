'use strict';

var gulp         = require('gulp');
var sass         = require('gulp-sass');
var postcss      = require('gulp-postcss');
var cssnano      = require('cssnano');
var rename       = require('gulp-rename');
var uglify       = require('gulp-uglify');
var browser_sync = require('browser-sync');
var autoprefixer = require('autoprefixer');
var rimraf       = require('rimraf');
var runSequence  = require('run-sequence');
var zip          = require('gulp-zip');
var rollup       = require('gulp-rollup');
var nodeResolve  = require('rollup-plugin-node-resolve');
var commonjs     = require('rollup-plugin-commonjs');
var babel        = require('rollup-plugin-babel');

var dir = {
  src: {
    css     : 'resources/src/css',
    js      : 'resources/src/js',
    img     : 'resources/src/img',
    packages: 'node_modules'
  },
  dist: {
    css     : 'resources/assets/css',
    js      : 'resources/assets/js',
    img     : 'resources/assets/img',
    packages: 'resources/assets/packages'
  }
}

/**
 * Remove directory for copied node modules
 */
gulp.task('remove-packages-dir', function(cb) {
  rimraf(dir.dist.packages, cb);
});

/**
 * Copy dependencies node modules to src directory
 */
gulp.task('packages', ['remove-packages-dir'], function(cb) {
  var packages = [
    dir.src.packages + '/font-awesome/**',
    dir.src.packages + '/slick-carousel/**',
    dir.src.packages + '/jquery.sticky/**',
    dir.src.packages + '/jquery.background-parallax-scroll/**'
  ];
  return gulp.src(packages, {base: 'node_modules'})
    .pipe(gulp.dest(dir.dist.packages));
});

/**
 * Remove images in assets directory
 */
gulp.task('remove-images', function(cb) {
  rimraf(dir.dist.img, cb);
});

/**
 * Copy images to assets directory
 */
gulp.task('img',['remove-images'], function() {
  return gulp.src(dir.src.img + '/**/*')
    .pipe(gulp.dest(dir.dist.img));
});

/**
 * Build CSS
 */
gulp.task('css', function() {
  return sassCompile(dir.src.css + '/*.scss', dir.dist.css)
    .on('end', function() {
      return gulp.src(dir.src.css + '/**/*.php')
        .pipe(gulp.dest(dir.dist.css));
    });
});

function sassCompile(src, dest) {
  return gulp.src(src)
    .pipe(sass({
      includePaths: require('node-normalize-scss').includePaths
    }))
    .pipe(postcss([
      autoprefixer({
        browsers: ['last 2 versions'],
        cascade: false
      })
    ]))
    .pipe(gulp.dest(dest))
    .pipe(postcss([
      cssnano({
        'zindex': false
      })
    ]))
    .pipe(rename({suffix: '.min'}))
    .pipe(gulp.dest(dest))
}

/**
 * Build javascript
 */
gulp.task('js', function() {
  runSequence('js:app');
});
gulp.task('js:app', function() {
  return jsCompile('app.js');
});

function jsCompile(distFileName) {
  return gulp.src(dir.src.js + '/**/*.js')
    .pipe(rollup({
      allowRealFiles: true,
      entry: dir.src.js + '/' + distFileName,
      format: 'iife',
      external: ['jquery', '_', 'Backbone'],
      globals: {
        jquery: "jQuery"
      },
      plugins: [
        nodeResolve({ jsnext: true }),
        commonjs(),
        babel({
          presets: ['es2015-rollup'],
          babelrc: false
        })
      ]
    }))
    .pipe(gulp.dest(dir.dist.js))
    .on('end', function() {
      gulp.src([dir.dist.js + '/' + distFileName])
        .pipe(uglify())
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest(dir.dist.js));
    });
}

/**
 * Build
 */
gulp.task('build', ['packages', 'img'], function() {
  return runSequence('css', 'js');
});

/**
 * browsersync
 */
gulp.task('browsersync', function() {
  browser_sync.init({
    proxy: '127.0.0.1:8080',
		files: [
      '**/*.php',
      dir.dist.js + '/app.min.js',
      dir.dist.css + '/style.min.css'
		]
  });
});

/**
 * Creates the zip file
 * This command must be build beforehand on Travis CI !!
 */
gulp.task('zip', function(){
  return gulp.src(
      [
        '**',
        '!node_modules',
        '!node_modules/**',
        '!package.json',
        '!gulpfile.js',
        '!yarn.lock',
      ],
      {base: './'}
    )
    .pipe(zip('snow-monkey.zip'))
    .pipe(gulp.dest('./'));
});

/**
 * Auto build and browsersync
 */
gulp.task('default', ['build', 'browsersync'], function() {
  gulp.watch([dir.src.css + '/**/*.scss'], ['css']);
  gulp.watch([dir.src.js + '/**/*.js'] , ['js']);
  gulp.watch([dir.src.img + '/**'] , ['img']);
});
