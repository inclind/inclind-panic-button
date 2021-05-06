// Initialize modules
// Importing specific gulp API functions lets us write them below as series() instead of gulp.series()
const { src, dest, watch, series, parallel, task } = require('gulp');
// Importing all the Gulp-related packages we want to use
const sourcemaps = require('gulp-sourcemaps');
const sass = require('gulp-sass');
const concat = require('gulp-concat');
const uglify = require('gulp-uglify');
const postcss = require('gulp-postcss');
const autoprefixer = require('autoprefixer');
const cssnano = require('cssnano');
const rename = require('gulp-rename');
var replace = require('gulp-replace');
const purgecss = require('gulp-purgecss');


// File paths
const files = {
	scssPath: 'src/scss/**/inclind-panic-button.scss',
	allScssPath: 'src/scss/**/*.scss',
	jsPath: 'src/js/**/*.js',
}

// Sass task: compiles the style.scss file into style.css
function scssTask(){
	return src(files.scssPath)
		.pipe(sourcemaps.init()) // initialize sourcemaps first
		.pipe(sass().on('error', sass.logError)) // compile SCSS to CSS
		// .pipe(postcss([ tailwindcss('./tailwind.config.js'), autoprefixer() ])) // PostCSS plugins
		.pipe(postcss([ autoprefixer() ])) // PostCSS plugins
		// .pipe(purgecss({ content: [files.htmlPath] }))
		.pipe(dest('./public/css/'))
		.pipe(rename({suffix: '.min'}))
		.pipe(postcss([ cssnano() ]))
		.pipe(sourcemaps.write('.')) // write sourcemaps file in current directory
		.pipe(dest('./public/css/')
	); // put final CSS in dist folder
}

// JS task: concatenates and uglifies JS files to script.js
function jsTask(){
	return src([
		files.jsPath
		//,'!' + 'includes/js/jquery.min.js', // to exclude any specific files
		])
		.pipe(concat('inclind-panic-button.js'))
		.pipe(uglify())
		.pipe(dest('./public/js/')
	);
}

// Watch task: watch SCSS and JS files for changes
// If any change, run scss and js tasks simultaneously
function watchTask(){
	watch([files.allScssPath, files.jsPath],
		series(
			scssTask,
			jsTask
		)
	);
}


// Export the default Gulp task so it can be run
// Runs the scss and js tasks simultaneously
exports.default = series(
	parallel(scssTask, jsTask),
	watchTask
);

// Tasking
task( 'build:js', jsTask);
task( 'build:css', scssTask);
task( 'watch', watchTask);