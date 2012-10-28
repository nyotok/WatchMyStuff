// This code is to be minified and bookmarked
var WMS = {
	authToken: '',
	jQueryVersion: '1.8.2',
	jQueryLoaded: function() {
		return (
			(typeof window.jQuery != 'undefined') && 
			(window.jQuery.fn.jquery == this.jQueryVersion)
		);
	},
	init: function() {
		// Check if jQuery loaded
		if (! this.jQueryLoaded()) {
			// Load jQuery
			var jQ = document.createElement('script');
			jQ.type = 'text/javascript';
			jQ.src = 'http://ajax.googleapis.com/ajax/libs/jquery/' + 
				this.jQueryVersion + '/jquery.min.js';
			document.getElementsByTagName('body')[0].appendChild(jQ);
		}
		
		// Start waiting for jQuery to load
		this.wait();
	},
	wait: function() {
		// Wait until jQuery is loaded, then proceed to the next step
		if (this.jQueryLoaded()) {
			this.load();
		} else {
			setTimeout(function(){WMS.wait();}, 50);
		}
	},
	load: function() {
		window.jQuery.getScript(
			'http://www.wms.prigix.com/js/WMSscript.js',
			function(){
				// On success, use this global variable to store the 
				// authentication token
				WMSauthToken = WMS.authToken;
			}
		);
	},
	setToken: function(i) {
		if (typeof i == 'undefined') i = 20;
		if (i < 1) return false;
		
		if (typeof WMSauthToken == 'string') {
			WMSauthToken = WMS.authToken;
		} else {
			setTimeout(function(){
				return WMS.setToken(i - 1);
			}, 20);
		}
		
		return true;
	}
};
WMS.init();