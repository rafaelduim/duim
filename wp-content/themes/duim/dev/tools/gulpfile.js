var gulp = require('gulp'),
    sass = require('gulp-sass'),
    sourcemaps = require('gulp-sourcemaps'),
    uglify = require('gulp-uglify'),
    autoPrefixer = require('gulp-autoprefixer'),
    cssmin = require('gulp-cssmin'),
    rename = require('gulp-rename'),
    clean = require('gulp-clean'),
    plumber = require('gulp-plumber'),
    concat = require('gulp-concat'),
    imagemin = require('gulp-imagemin'),
    spritesmith = require('gulp.spritesmith'),
    merge = require('merge-stream'),
    buffer = require('vinyl-buffer'),
    build = require('./config/default.json');

//#region SASS
function cleanCss() {
    return(
        gulp
            .src(build.config.dist.css,{allowEmpty:true})
            .pipe(clean({ force: true }))
    );
}
function buildSass() {
    return (
        gulp
            .src(build.config.dev.scss + '/**/*.scss',{allowEmpty:true})
            .pipe(sourcemaps.init())
            .pipe(sass().on('error', sass.logError))
            .pipe(autoPrefixer())
            .pipe(sourcemaps.write())
            .pipe(cssmin())
            .pipe(rename({ suffix: '.min' }))
            .pipe(gulp.dest(build.config.dist.css))
    );
}
function buildBundleCss() {
    return (
        gulp
            .src(build.config.dist.css + "/**/*.css",{allowEmpty:true})
            .pipe(concat('bundle.styles.css'))
            .pipe(gulp.dest(build.config.dist.css))
    );
}

const compileSass = gulp.series(cleanCss, buildSass);
const compileBundleCss = gulp.series(cleanCss, buildSass, buildBundleCss);

exports.cleanCss = cleanCss;
exports.buildSass = buildSass;
exports.sass = compileSass;
exports.bundleStyles = compileBundleCss;

//#endregion

//#region SCRIPTS
function cleanScript() {
    return(
        gulp
            .src(build.config.dist.js,{allowEmpty:true})
            .pipe(clean({ force: true }))
    );
}
function buildScript() {
    return (
        gulp
            .src(build.config.dev.js + '/*.js',{allowEmpty:true})
            .pipe(plumber({
                handleError: function(error) {
                    console.log(error);
                    this.emit('end');
                }
            }))
            .pipe(gulp.dest(build.config.dist.js))
            .pipe(uglify())
            .pipe(rename({ suffix: '.min' }))
            .pipe(gulp.dest(build.config.dist.js))
    );
}

const compileBundleScript = gulp.series(cleanScript, buildScript);

exports.buildScript = buildScript;
exports.bundleScript = compileBundleScript;

//#endregion

//#region PLUGINS
function cleanPlugins() {
    return(
        gulp
            .src(build.config.dist.plugins,{allowEmpty:true})
            .pipe(clean({ force: true }))
    );
}
function buildPlugins() {
    return (
        gulp
            .src(build.config.dev.plugins)
            .pipe(plumber({
                handleError: function(error) {
                    console.log(error);
                    this.emit('end');
                }
            }))
            .pipe(concat('bundle.plugins.js'))
            .pipe(gulp.dest(build.config.dist.plugins))
    );
}

const compileBundlePlugins = gulp.series(cleanPlugins, buildPlugins);

exports.buildPlugins = buildPlugins;
exports.bundlePlugins = compileBundlePlugins;

//#endregion

//#region IMAGES
function cleanImages() {
    return(
        gulp
            .src(build.config.dist.images,{allowEmpty:true})
            .pipe(clean({ force: true }))
    );
}
function buildSprite() {
    var spriteData = gulp.src(build.config.dev.images + '/sprite/**/*',{allowEmpty:true}).pipe(spritesmith({
        imgName: build.config.names.sprite,
        cssName: build.config.names.sprite_scss,
        imgPath: build.config.image_css + build.config.names.sprite,
        padding: 1
    }));

    var imgStream = spriteData.img
        .pipe(buffer())
        .pipe(imagemin())
        .pipe(gulp.dest(build.config.dist.images + '/sprite/'));
    // Pipe CSS stream through CSS optimizer and onto disk
    var cssStream = spriteData.css
        .pipe(gulp.dest(build.config.dev.scss + '/helpers/'));
    // Return a merged stream to handle both `end` events

    return merge(imgStream, cssStream);
}
function buildImages() {
    return (
        gulp
            .src(build.config.dev.images + '/*',{allowEmpty:true})
            .pipe(buffer())
            .pipe(imagemin())
            .pipe(gulp.dest(build.config.dist.images))
    );
    
}
function buildIcons() {
    return (
        gulp
            .src(build.config.dev.images + '/icones/*',{allowEmpty:true})
            .pipe(gulp.dest(build.config.dist.images + '/icones'))
    );
}

function buildFavicon() {
    return (
        gulp
            .src(build.config.dev.images + '/favicon/*',{allowEmpty:true})
            .pipe(gulp.dest(build.config.dist.images + '/favicon'))
    );
}

const compileBundleImages = gulp.series(cleanImages, gulp.parallel(buildSprite,buildImages,buildIcons,buildFavicon));

exports.bundlebuildSprite = buildSprite;
exports.buildImages = buildImages;
exports.bundleImages = compileBundleImages;

//#endregion

//#region FONTS
function cleanFonts() {
    return(
        gulp
            .src(build.config.dist.fonts,{allowEmpty:true})
            .pipe(clean({ force: true }))
    );
}
function buildFonts() {
    return (
        gulp
            .src(build.config.dev.fonts + '/**/*',{allowEmpty:true})
            .pipe(gulp.dest(build.config.dist.fonts))
    );
}

const compileBundleFonts = gulp.series(cleanFonts, buildFonts);

exports.buildFonts = buildFonts;
exports.bundleFonts = compileBundleFonts;

//#endregion

//#region WATCH
function watch() {
    gulp.watch(build.config.dev.scss + '/**/*.scss', compileBundleCss);
    gulp.watch(build.config.dev.js + '/**/*.js', compileBundleScript);
    gulp.watch(build.config.dev.images + '/**/*', compileBundleImages);
    gulp.watch(build.config.dev.plugins + '/**/**/*', compileBundlePlugins);
    gulp.watch(build.config.dev.fonts + '/**/**/*', compileBundleFonts);
}

exports.watch = watch;

//#endregion

//#region DEFAULT
const compileGulp = gulp.series(compileBundleCss, compileBundleScript, compileBundleImages, compileBundlePlugins, compileBundleFonts);
exports.default = compileGulp;

//#endregion