var gulp = require( "gulp" );
var concat = require( "gulp-concat" );
var uglify = require( "gulp-uglify" );
var sourcemaps = require( "gulp-sourcemaps" );
var vendorScripts = [
];


var vendorScripts = [
  "./node_modules/jquery-mousewheel/jquery.mousewheel.js",
  "./node_modules/vanilla-lazyload/dist/lazyload.min.js",
  "./node_modules/slick-carousel/slick/slick.min.js",
  "./node_modules/hypher/dist/jquery.hypher.js",
  "./node_modules/videojs-contrib-hls-s1/dist/videojs-contrib-hls.min.js"
];


gulp.task( "vendors", function() {
	return gulp.src( vendorScripts )
    .pipe( sourcemaps.init() )
    .pipe( concat( "vendor.min.js" ) )
    .pipe( uglify() )
    .pipe( sourcemaps.write() )
    .pipe( gulp.dest( "assets/js/" ) );
});
 