var fs = require('fs');
var archiver = require('archiver');
var packageName = 'inclind-panic-button';
var packageNameDir = packageName + '/';

// Get the version
try {
	var version = fs.readFileSync('version.txt', 'utf8');
	version = version.toString();
} catch(e) {
	console.log('Error:', e.stack);
}

// Setup the file to stream
const output = fs.createWriteStream('release/' + packageName + '.' + version + '.zip');
const archive = archiver('zip', {
	zlib: { level: 9 } // Sets the compression level.
});

// This event is fired when the data source is drained no matter what was the data source.
// It is not part of this library but rather from the NodeJS Stream API.
// @see: https://nodejs.org/api/stream.html#stream_event_end
output.on('end', function() {
	console.log('Data has been drained');
});

// Give the user a nice message
output.on('close', function () {
	console.log(archive.pointer() + ' total bytes');
	console.log('archiver has been finalized and the output file descriptor has closed.');
	console.log('File can be found @ ./release/'  + packageName + '.' + version + '.zip');
	console.log('\x1b[33m%s\x1b[0m', 'PLEASE DO NOT COMMIT THE ZIP');
});

// good practice to catch warnings (ie stat failures and other non-blocking errors)
archive.on('warning', function(err) {
	if (err.code === 'ENOENT') {
		// log warning
	} else {
		// throw error
		throw err;
	}
});

// good practice to catch this error explicitly
archive.on('error', function(err) {
	throw err;
});

// pipe archive data to the file
archive.pipe(output);

// What to grab
archive.directory('acf-json', packageNameDir + 'acf-json');
archive.directory('admin', packageNameDir + 'admin');
archive.directory('includes', packageNameDir + 'includes');
archive.directory('languages', packageNameDir + 'languages');
archive.directory('public', packageNameDir + 'public');

archive.file( packageNameDir + 'inclind-panic-button.php' );
archive.file( packageNameDir + 'index.php' );
archive.file( packageNameDir + 'LICENSE.txt' );
archive.file( packageNameDir + 'README.txt' );
archive.file( packageNameDir + 'uninstall.php' );


// finalize the archive (ie we are done appending files but streams have to finish yet)
// 'close', 'end' or 'finish' may be fired right after calling this method so register to them beforehand
archive.finalize();