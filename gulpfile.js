// プラグインの読み込み
const gulp = require('gulp');
const sass = require('gulp-sass');
const sassGlob = require('gulp-sass-glob');
const plumber = require('gulp-plumber');
const notify = require('gulp-notify');
const postcss = require('gulp-postcss');
const autoprefixer = require('autoprefixer');
const cssdeclsort = require('css-declaration-sorter');
const browserSync = require('browser-sync');
const imagemin = require('gulp-imagemin');
const imageminJpg = require('imagemin-jpeg-recompress');
const imageminPng = require('imagemin-pngquant');
const imageminGif = require('imagemin-gifsicle');
const svgmin = require('gulp-svgmin');
const changed = require('gulp-changed');

gulp.task('sass', function () {
  return gulp
    .src('./sass/**/*.scss')
    .pipe(plumber({ errorHandler: notify.onError('Error: <%= error.message %>') }))
    .pipe(sassGlob())
    .pipe(sass({ outputStyle: 'expanded' }))
    .pipe(postcss([autoprefixer()]))
    .pipe(postcss([cssdeclsort({ order: 'alphabetical' })]))
    .pipe(gulp.dest('./css'));
});

// gulp.task('browser-sync', function (done) {
//   browserSync.init({
//     server: {
//       baseDir: './',
//       index: 'index.html',
//     },
//   });
//   done();
// });

// ブラウザのリロード
gulp.task('bs-reload', function (done) {
  browserSync.reload();
  done();
});

// 画像の圧縮
var paths = {
  srcDir: 'img',
  dstDir: 'dist',
};

gulp.task('imagemin', function (done) {
  var srcGlob = paths.srcDir + '/*.+(jpg|jpeg|png|gif)';
  var dstGlob = paths.dstDir;
  gulp
    .src(srcGlob)
    // .pipe(changed(dstGlob))
    .pipe(
      imagemin([
        imageminPng(),
        imageminJpg(),
        imageminGif({
          interlaced: false,
          optimizationLevel: 3,
          colors: 180,
        }),
      ])
    )
    .pipe(gulp.dest('./img/dist'));
  done();
});
// svg画像の圧縮タスク
gulp.task('svgmin', function (done) {
  var srcGlob = paths.srcDir + '/*.+(svg)';
  var dstGlob = paths.dstDir;
  gulp.src(srcGlob).pipe(svgmin()).pipe(gulp.dest('./img/dist'));
  done();
});

gulp.task('watch', function () {
  gulp.watch('./sass/**/*.scss', gulp.task('sass'));
  // gulp.watch('./sass/**/*.scss', gulp.task('bs-reload'));
  // gulp.watch('../*.php', gulp.task('bs-reload'));
  // gulp.watch('./css/*.css', gulp.task('bs-reload'));
  // gulp.watch('./js/*.js', gulp.task('bs-reload'));
  gulp.watch('./img/*', gulp.task('imagemin'));
  gulp.watch('./img/*', gulp.task('svgmin'));
});

// gulp.task('default', gulp.series(gulp.parallel('browser-sync', 'watch')));
gulp.task('default', gulp.series(gulp.parallel('watch')));
