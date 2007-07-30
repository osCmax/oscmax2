// Though "Dialog" looks like an object, it isn't really an object.  Instead
// it's just namespace for protecting global symbols.

function Dialog(url, action, init) {
	if (typeof init == "undefined") {
		init = window;	// pass this window object by default
	}
	if (document.all) {	// here we hope that Mozilla will never support document.all
		var value =
			showModalDialog(url, init,
//			window.open(url, '_blank',
					"resizable: no; help: no; status: no; scroll: no");
		if (action) {
			action(value);
		}
	} else {
		return Dialog._geckoOpenModal(url, action, init);
	}
};

Dialog._parentEvent = function(ev) {
	if (Dialog._modal && !Dialog._modal.closed) {
		Dialog._modal.focus();
		// we get here in Mozilla only, anyway, so we can safely use
		// the DOM version.
		ev.preventDefault();
		ev.stopPropagation();
	}
};

// should be a function, the return handler of the currently opened dialog.
Dialog._return = null;

// constant, the currently opened dialog
Dialog._modal = null;

// the dialog will read it's args from this variable
Dialog._arguments = null;

Dialog._geckoOpenModal = function(url, action, init) {
	var dlg = window.open(url, "ha_dialog"+url,
			      "toolbar=no,menubar=no,personalbar=no,width=10,height=10," +
			      "scrollbars=no,resizable=no");
	Dialog._modal = dlg;
	Dialog._arguments = init;

	// capture some window's events
	function capwin(w) {
		w.addEventListener("click", Dialog._parentEvent, true);
		w.addEventListener("mousedown", Dialog._parentEvent, true);
		w.addEventListener("focus", Dialog._parentEvent, true);
	};
	// release the captured events
	function relwin(w) {
		w.removeEventListener("focus", Dialog._parentEvent, true);
		w.removeEventListener("mousedown", Dialog._parentEvent, true);
		w.removeEventListener("click", Dialog._parentEvent, true);
	};
	capwin(window);
	// capture other frames
	for (var i = 0; i < window.frames.length; capwin(window.frames[i++]));
	// make up a function to be called when the Dialog ends.
	Dialog._return = function (val) {
		if (val && action) {
			action(val);
		}
		relwin(window);
		// capture other frames
		for (var i = 0; i < window.frames.length; relwin(window.frames[i++]));
		Dialog._modal = null;
	};
};


function __dlg_onclose() {
	if (!document.all) {
		opener.Dialog._return(null);
	}
};

function __dlg_init() {
	if (!document.all) {
		// init dialogArguments, as IE gets it
		window.dialogArguments = opener.Dialog._arguments;
		window.sizeToContent();
		window.sizeToContent();	// for reasons beyond understanding,
					// only if we call it twice we get the
					// correct size.
		window.addEventListener("unload", __dlg_onclose, true);
		/*
		// center on parent
		var px1 = opener.screenX;
		var px2 = opener.screenX + opener.outerWidth;
		var py1 = opener.screenY;
		var py2 = opener.screenY + opener.outerHeight;
		var x = (px2 - px1 - window.outerWidth) / 2;
		var y = (py2 - py1 - window.outerHeight) / 2; */

		//centre on screen instead
		var x = (screen.width - window.outerWidth) / 2;
		var y = (screen.height - window.outerHeight) / 2;

		window.moveTo(x, y);
		var body = document.body;
		window.innerHeight = body.offsetHeight;
		window.innerWidth = body.offsetWidth;
	} else {
		var body = document.body;
		window.dialogHeight = body.offsetHeight + 50 + "px";
		window.dialogWidth = body.offsetWidth + "px";
	}
};

// closes the dialog and passes the return info upper.
function __dlg_close(val) {
	if (document.all) {	// IE
		window.returnValue = val;
	} else {
		opener.Dialog._return(val);
	}
	window.close();
};
