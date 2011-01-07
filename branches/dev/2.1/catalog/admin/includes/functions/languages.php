<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

  function tep_get_languages_directory($code) {
    global $languages_id;

    $language_query = tep_db_query("select languages_id, directory from " . TABLE_LANGUAGES . " where code = '" . tep_db_input($code) . "'");
    if (tep_db_num_rows($language_query)) {
      $language = tep_db_fetch_array($language_query);
      $languages_id = $language['languages_id'];
      return $language['directory'];
    } else {
      return false;
    }
  }
?>