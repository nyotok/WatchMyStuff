var WMSauthToken = '';
(function($){
	var WMSenabled = true;
	
	// Global switch for the WMS app
	function enableWMS() {
		WMSenabled = true;
		$('p.enable', $globalSwitch).hide();
		$('p.disable', $globalSwitch).show();
		$overlayBg.show();
	}
	function disableWMS() {
		WMSenabled = false;
		$('p.enable', $globalSwitch).show();
		$('p.disable', $globalSwitch).hide();
		removeHighlight();
		$overlayBg.hide();
	}
	
	/**
	 * Returns the CSS path of $element starting from body
	 * 
	 * @params object $element A jQuery object of the current DOM element 
	 *					to get the path
	 * @params string path The string containing the current path
	 * @return mixed Returns the path string on success or FALSE on failure
	 */
	function findElementPath($element, path) {
		var currentSelector = $element[0].nodeName.toLowerCase();
		var selectorAppend = '';
		
		// Search the current element for an ID or an unique class
		if ($element.attr('id') && ($element.attr('id').search('#') == -1)) {
			selectorAppend = '#' + $element.attr('id');
		} else {
			var uniqueClass = classUniqueAmongstSiblings($element);
			if (uniqueClass) selectorAppend = '.' + uniqueClass;
		}
		
		// Append to path any ID or unique class we found
		if (selectorAppend) currentSelector += selectorAppend;
		
		// Update the path
		if (typeof path == 'undefined') {
			// First run of this function? Initialize the path
			path = currentSelector;
		} else {
			// Prepend the current selector to extend the path
			path = currentSelector + ' ' + path;
		}
		
		// Check if the path can be further extended
		var $parent = $element.parent();
		var parentName = $parent[0].nodeName.toLowerCase();
		if (($parent[0] != document) && parentName && (parentName != 'body')) {
			// Continue extending the path recursively if possible ...
			return findElementPath($parent, path);
		} else {
			// ... else finish the recursiveness
			return path;
		}
	}
	
	/**
	 * If the $element has HTML classes, the function tries to find one of them
	 * that make the element unique amongst its siblings
	 * 
	 * @params object $element jQuery element find the class for
	 * @return mixed Returns the class on success or FALSE on failure
	 */
	function classUniqueAmongstSiblings($element) {
		// Drop on empty class
		if (! $element.attr('class')) return false;
		
		// If the element has no siblings, its first class is considered unique
		if ($element.siblings().length == 0) {
			return $element.attr('class').split(' ')[0];
		}
		
		var uniqueClass = false;
		$($element.attr('class').split(' ')).each(function(){
			// Continue searching if this is not a valid class
			if (this == '') return false;
			
			// Look for this class along all siblings
			var currentClass = this;
			
			// Assume the class is unique
			var currentClassUnique = true;
			
			// Search the siblings for this class
			$element.siblings().each(function(){
				// Stop searching if a sibling is found
				if ($(this).hasClass(currentClass)) {
					currentClassUnique = false;
					return false;
				}
				return true;
			});
			
			// Decide if we stop searching
			if (currentClassUnique) {
				// Consider this class unique and stop the search
				uniqueClass = currentClass;
				return false;
			}
			
			return true;
		});
		
		return uniqueClass;
	}
	
	/**
	 * Shows a highlight around the element found at <path>
	 * 
	 * @params object clickEvent The jQuery event raised from clicking 
	 *								on the overlay
	 * @params string path CSS path to the element to be highlighted
	 * @return boolean TRUE on success, FALSE on failure
	 */
	function highlightElement(clickEvent, path) {
		var $element = $(path);
		if ($element.length != 1) return false;
		
		// Get the absolute position of the selected element
		var offset = $element.offset();
		// Then move the bordered overlay to the exact position of the element
		$overlayElement
			.css('left', offset.left)
			.css('top', offset.top)
			.width($element.outerWidth() - 4)
			.height($element.outerHeight() - 4)
			.show();
		
		// Position and display the save button
		$overlaySaveBtn
			.css('left', clickEvent.pageX + 10)
			.css('top', clickEvent.pageY + 10)
			.show();
		
		
		return true;
	}
	
	// Function that removes the highlight on the current element
	function removeHighlight() {
		$overlayElement.hide();
		$overlaySaveBtn.hide();
	}
	
	//== HTML Elements =========================================================
	
	// Display a global switch inside the website
	$('body').append('<div id="WMSswitch" style="position: fixed; z-index: '+
		'10002; padding: 5px; top: 15px; left: 15px; width: 133px; height: '+
		'auto; border: solid 1px #CFCFCC; background: #F6F6F5;font-family: '+
		'Arial,Helvetica,sans-serif;font-size:10px;"><img '+
		'src="http://www.wms.prigix.com/images/wms_logo_book.png" alt="" /><p '+
		'class="enable" style="display: none;">WatchMySystem este dezactivat. '+
		'<br /><a href="#">Activeaza</a></p><p class="disable" '+
		'style="margin:0;color:#212121;text-align:left;">Click pe continutul '+
		'favorit pentru a-l monitoriza.<br /><a href="#" style="padding-top: '+
		'5px;text-decoration:underline;">Dezactiveaza</a></p></div>');
	var $globalSwitch = $('#WMSswitch');
	
	// Bind the click events for the switch
	$('p.enable', $globalSwitch).click(function(){
		enableWMS();
		return false;
	});
	$('p.disable', $globalSwitch).click(function(){
		disableWMS();
		return false;
	});
	
	// Insert a highlighting overlay element in the <body> HTML tag
	$('body').append('<div id="WMSoverlay" style="display:none; '+
		'position: absolute; z-index: 9999;width: 0; height: 0; top: 0; '+
		'left: 0; border: solid 2px rgba(82, 168, 236, 0.8); '+
		'box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px '+
		'rgba(82, 168, 236, 0.6);"></div>');
	var $overlayElement = $('#WMSoverlay');
	
	// Also, insert a "Save" button shown near your mouse; clicking it will
	// trigger in the server-side content monitoring system
	$('body').append('<a id="WMSsaveBtn" style="display:none; '+
		'position: absolute; z-index: 10001; top: 0; background: #FFF; '+
		'left: 0; border: solid 1px #222222; cursor: pointer; color: #4b9002; '+
		'font-size: 14px; font-weight: bold; padding: 5px 10px;'+
		'-moz-border-radius:3px 3px 0 0;-webkit-border-radius:3px 3px 0 0;'+
		'-khtml-border-radius:'+
		'3px 3px 0 0;border-radius:3px 3px 0 0;-moz-box-shadow: 0 0 15px #212121;-webkit-box-shadow: 0 0 15px #212121;box-shadow: 0 0 15px #212121;-ms-filter: "progid:DXImageTransform.Microsoft.Shadow(Strength=15, Direction=90, Color=\'#212121\')";filter: progid:DXImageTransform.Microsoft.Shadow(Strength=15, Direction=90, Color=\'#212121\');">Salveaza</a>');
	var $overlaySaveBtn = $('#WMSsaveBtn');
	$overlaySaveBtn.click(function(){
		if (typeof $(this).data('WMSclick') == 'function') {
			// This function is defined within the getHover() function
			($(this).data('WMSclick'))();
		}
		return false;
	});
	
	// General overlay, covering all the website and catching all click events
	// This is needed in order not to trigger any event in the host page
	$('body').append('<div id="WMSoverlayBg" style="'+
		'position: absolute; z-index: 10000;width: 100%; height: 100%; top: 0;'+
		'left: 0;"></div>');
	var $overlayBg = $('#WMSoverlayBg');
	
	// Define the click event that searches for the hovered element
	$overlayBg.click(function(event){
		$('#mo-counter').html(parseInt($('#mo-counter').html()) + 1);
		
		// Remove the active highlight, if any
		removeHighlight();
		
		// Start by removing the click-catcher overlay, in order to
		// figure out what is the element the user clicked on.
		$overlayBg.hide();
		
		// jQuery wrapper with the selected/clicked element
		var $clickedElement;
		
		// Find the element that is hovered with the mouse
		var getHover = function(){
			if ($(':hover').last().attr('id') == 'WMSoverlayBg') {
				// Retry the operation until the background overlay is properly
				// hidden in the browser
				setTimeout(function(){
					getHover();
				}, 20);
			} else {
				// Store the clicked element just after it is detected...
				$clickedElement = $(':hover', $('body')).last();
				// ...and reenable the click-catcher overlay afterwards
				$overlayBg.show();
				
				// Disallow elements outside the <body> tag
				if ($clickedElement.length == 0) {
					return false;
				}
				
				// Find the full path of the clicked element...
				var elementPath = findElementPath($clickedElement);
				// ...but continue only if the path leads to 
				// one and only one element
				if ($(elementPath).length == 1) {
					// We can consider the path as leading to an unique element,
					// making it suitable for highlighting and clicking
					highlightElement(event, elementPath);
					
					$overlaySaveBtn.data('WMSclick', function(){
						// Send the request to the server
						var data = {
							url: document.URL.split('#')[0],
							tag: elementPath,
							token: WMSauthToken
						};
						window.open('http://www.wms.prigix.com/add_url.php?' + 
							$.param(data), '_blank');
					});
				}
			}
			return true;
		}
		
		// Start the recursive loop of getting the clicked element
		getHover();
	});
})(jQuery);