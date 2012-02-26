<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

function amSessionUnregister($strSessionVar) {
	if(amSessionIsRegistered($strSessionVar)){
		tep_session_unregister($strSessionVar);
	}
	unset($GLOBALS[$strSessionVar]);
}

function amSessionRegister($strSessionVar,$value = '') {
	if(!amSessionIsRegistered($strSessionVar)) {
		tep_session_register($strSessionVar);
		$GLOBALS[$strSessionVar] = $value;
	}
}

function amSessionIsRegistered($strSessionVar) {
	return tep_session_is_registered($strSessionVar);
}

function &amGetSesssionVariable($strSessionVar) {
	if(isset($GLOBALS[$strSessionVar]))
		return $GLOBALS[$strSessionVar];
	return false;
}

function amSetSessionVariable($key, $value) {
	$GLOBALS[$key] = $value;
}
?>