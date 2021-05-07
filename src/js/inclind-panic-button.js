(function() {
	// Wait for the content to load
	document.addEventListener('DOMContentLoaded', () => {
		// Two buttons
		var inclindPanicBtn = document.getElementById("inclind-panic-button");
		var inclindPanicBtnFixed = document.getElementById("inclind-panic-button-fixed");

		// If button exists
		if ( inclindPanicBtn ) {
			inclindPanicBtn.addEventListener( 'click', inclindPanicBtnDriver );
		}

		// If fixed button exists
		if ( inclindPanicBtnFixed ) {
			inclindPanicBtnFixed.addEventListener( 'click', inclindPanicBtnDriver );
		}
	});


	function inclindPanicBtnDriver(e) {

		// Save the button
		var button = e.target;

		// Save the variables
		var redirectUrl = button.dataset.redirectUrl;

		// Immediatley clean the page incase internet is not good
		document.body.innerHTML = ""; // All content
		document.head.innerHTML = ""; // All content
		document.body.className = ""; // All classes
		document.title = '500 Server Error';

		// Start the redirect
		inclindPanicBtnRedirect(redirectUrl);

		// Clear as much history as possible
		if(window.history) {
			try {
				window.history.replaceState({}, '', '/');
			} catch(e) {
			}
		}
	}

	// Redirect function
	function inclindPanicBtnRedirect(location) {
		// See if the URL is valid
		var urlRegEx = /^https?:\/\/(?:www\.)?[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b([-a-zA-Z0-9()@:%_\+.~#?&//=]*)$/gm;

		// Redirect
		if ( urlRegEx.test(location) ) {
			window.location.replace(location);
		} else {
			console.error(location + ' is not a valid url');
		}
	}
})();