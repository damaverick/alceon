const { src, dest, watch, series } = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const cleanCSS = require('gulp-clean-css');
const concat = require('gulp-concat');
const sourcemaps = require('gulp-sourcemaps');
const rename = require('gulp-rename');
const browserSync = require('browser-sync').create();
const fs = require('fs');
const path = require('path');

// SSL cert paths (generated via mkcert)
const certDir = __dirname;

// Paths
const paths = {
  scss: 'src/sass/**/*.scss',
  mainScss: 'src/sass/child-theme.scss',
  css: 'css',
};

// Compile Sass
function compileSass() {
  return src(paths.mainScss)
    .pipe(sourcemaps.init({ loadMaps: true }))
    .pipe(sass().on('error', sass.logError))
    .pipe(cleanCSS()) // Minify
    .pipe(rename({ suffix: '.min' })) // <-- THIS RENAMES THE FILE
    .pipe(
      sourcemaps.write('./', {
        includeContent: false,
        sourceRoot: '../src/sass',
      }),
    )
    .pipe(dest(paths.css)) // Saves child-theme.min.css
    .pipe(browserSync.stream()); // Injects the CSS
}

// Watch for file changes
function watchFiles() {
  browserSync.init({
    proxy: 'https://alceon.local/',
    https: {
      key: path.join(certDir, 'localhost-key.pem'),
      cert: path.join(certDir, 'localhost.pem'),
    },
    notify: false,
  });

  watch(paths.scss, compileSass);
  // watch(`${paths.css}/**/*.css`).on("change", browserSync.reload); // Stays commented out
  watch(['./*.php', './includes/**/*.php', './templates/**/*.php']).on(
    'change',
    browserSync.reload,
  );
}

// Default Gulp task
exports.default = series(compileSass, watchFiles);
exports.compileSass = compileSass;
