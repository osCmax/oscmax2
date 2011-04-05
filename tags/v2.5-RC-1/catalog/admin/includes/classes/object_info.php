<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

  class objectInfo {

// class constructor
    function objectInfo($object_array) {
      reset($object_array);
      while (list($key, $value) = each($object_array)) {
		// Check if value is defined
		if (constant($value) != null) {
          $this->$key = constant($value);
		} else {
		  $this->$key = tep_db_prepare_input($value);
		}
      }
    }
  }
?>
