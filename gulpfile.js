const { src, dest, series } = require('gulp')
const concat = require('gulp-concat')
const terser = require('gulp-terser')
const cleanCSS = require('gulp-clean-css')
const purgeCSS = require('gulp-purgecss')
const htmlMin = require('gulp-htmlmin')
const rename = require('gulp-rename')
const inject = require('gulp-inject')

function treeShakeAndMinimizeMainCss () {
  return src([
    'assets/vendor/bootstrap/css/bootstrap.css',
    'assets/css/style.css',
  ])
    .pipe(concat('style.min.css'))  // Concatenate into a single file
    .pipe(purgeCSS({ content: ['index_dev.php', 'assets/js/**/*.js'] })) // Remove unused CSS
    .pipe(cleanCSS())  // Minify CSS
    .pipe(rename('style.min.css')) // Rename the output file
    .pipe(dest('assets/build')) // Output to the directory
}

function concatJsCssToMainCss () {
  return src([
    'assets/build/style.min.css',
    'assets/css/style-important.css',
  ])
    .pipe(concat('style.min.css'))  // Concatenate into a single file
    .pipe(cleanCSS())  // Minify CSS
    .pipe(rename('style.min.css')) // Rename the output file
    .pipe(dest('assets/build'))
}

function concatAndMinifyVendorsCss () {
  return series(
    function minifyPurgeSwiper() {
      return src('assets/vendor/swiper/swiper-bundle.min.css')
        .pipe(purgeCSS({ content: ['index_dev.php'] })) // Remove unused CSS
        .pipe(cleanCSS())  // Minify CSS
        .pipe(rename('swiper-bundle.min.css')) // Rename the output file
        .pipe(dest('./assets/build')) // Output to the directory
    },
    function minifyPurgeGlightbox() {
      return src('assets/vendor/glightbox/css/glightbox.css')
        .pipe(cleanCSS())  // Minify CSS
        .pipe(rename('glightbox.min.css')) // Rename the output file
        .pipe(dest('./assets/build')) // Output to the directory
    },
    function concatenateVendorsCss() {
      return src(['assets/build/swiper-bundle.min.css', 'assets/build/glightbox.min.css'])
        .pipe(concat('vendors.min.css'))  // Concatenate into a single file
        .pipe(dest('./assets/build')) // Output to the directory
    }
  );
}

function minifyAndConcatJs () {
  return src([
    // 'assets/vendor/bootstrap/js/bootstrap.bundle.js',
    'assets/vendor/swiper/swiper-bundle.min.js',
    'assets/vendor/glightbox/js/glightbox.js',
    'assets/vendor/purecounter/purecounter_vanilla.js',
    'assets/vendor/php-email-form/validate.js',
    'assets/js/main.js',
  ])
    .pipe(concat('script-bundle.min.js'))  // Concatenate into a single file
    .pipe(terser())  // Minify and treeshake JavaScript. comment out to turn off minification of js
    .pipe(rename('script-bundle.min.js')) // Rename the output file
    .pipe(dest('assets/build')) // Output to the directory
}

function injectFilesAndMinifyHtml () {
  return src('index_dev.php')
  .pipe(
    inject(src('assets/build/style.min.css', {read: true}), {
      starttag: '<!-- inject:css -->',
      endtag: '<!-- endinject:css -->',
      transform: (filePath, file) => {
        return ('<style>' + file.contents.toString() + '</style>')
      },
  })) // Inject main CSS into HTML
  .pipe(
    inject(src('assets/build/script-bundle.min.js', {read: true}), {
      starttag: '<!-- inject:js -->',
      endtag: '<!-- endinject:js -->',
      transform: (filePath, file) => {
        return ('<script nonce="<?= htmlspecialchars($nonce, ENT_QUOTES, \'UTF-8\') ?>">' + file.contents.toString() + '</script>');
      },
  })) 
  // Inject bundled JS into HTML. 

  .pipe(htmlMin({
    collapseWhitespace: true,
    removeComments: true,
    minifyCSS: true,
    minifyJS: true,
  })) // Minify HTML comment above to turn off minification
  .pipe(rename('index.php')) // Rename the output file
  .pipe(dest('.'))
}

const build = series(
  treeShakeAndMinimizeMainCss,
  concatJsCssToMainCss,
  concatAndMinifyVendorsCss(),
  minifyAndConcatJs,
  injectFilesAndMinifyHtml
)

exports.default = build
