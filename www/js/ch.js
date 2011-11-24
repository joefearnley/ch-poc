/**
 *
 * @author:	joe fearnley
 * @date:	10.26.09
 * @file:	ch.js
 *
 * This file contains misc js stuff.
 */

$.extend({
	getUrlVars: function(){
		var vars = [], hash;
		var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');

		for(var i = 0; i < hashes.length; i++) {
			hash = hashes[i].split('=');
			vars.push(hash[0]);
			vars[hash[0]] = hash[1];
		}
		return vars;
	},

	getUrlVar: function(name){
		return $.getUrlVars()[name];
	}
});

//var params = getUrlVars();
//var param = $.getUrlVar('param_name');

/**
 * Log some shit bro. Even if IE can't play
 */
function logMessage(data) {
	try {
		console.log(data);
	} catch(e) {
	}
}

/**
 * Log a warning to firebug.
 */
function logWarning(data) {
	try {
		console.warn(data);
	} catch(e) {
	}
}

/**
 * Log an error to firebug
 */
function logError(data) {
	try {
		console.error(data);
	} catch(e) {
	}
}

