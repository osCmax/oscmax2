<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

////
// ULTIMATE Seo Urls 5 by FWR Media
// The HTML href link wrapper function
  function tep_href_link($page = '', $parameters = '', $connection = 'NONSSL', $add_session_id = true, $search_engine_safe = true) {
    global $seo_urls, $languages_id, $request_type, $session_started, $sid;                
    if ( !is_object($seo_urls) ){
      include_once DIR_WS_MODULES . 'ultimate_seo_urls5' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'usu.php';
      $seo_urls = new usu($languages_id, $request_type, $session_started, $sid);
                }
        return $seo_urls->href_link($page, $parameters, $connection, $add_session_id);
  }

////
// The HTML image wrapper function
  function tep_image($src, $alt = '', $width = '', $height = '', $parameters = '') {
    if ( (empty($src) || ($src == DIR_WS_IMAGES . CATEGORY_IMAGES_DIR)) && (CATEGORY_IMAGE_REQUIRED == 'false') ) {
      return false;
    }
	
	// Adds missing image functionality 
	if ( ( (!file_exists($src)) || ($src == DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR) || ($src == DIR_WS_IMAGES . CATEGORY_IMAGES_DIR) ) && (PRODUCT_IMAGE_REPLACE == 'true') ) {
	  $src = DIR_WS_ICONS . 'default.png';
	  $alt = TEXT_MISSING_IMAGE;	
	}
	
// alt is added to the img tag even if it is null to prevent browsers from outputting
// the image filename as default
    $image = '<img src="' . tep_output_string($src) . '" class="img" alt="' . tep_output_string($alt) . '"';

    if (tep_not_null($alt)) {
      $image .= ' title=" ' . tep_output_string($alt) . ' "';
    }

    if ( (CONFIG_CALCULATE_IMAGE_SIZE == 'true') && (empty($width) || empty($height)) ) {
      if ($image_size = @getimagesize($src)) {
        if (empty($width) && tep_not_null($height)) {
          $ratio = $height / $image_size[1];
          $width = intval($image_size[0] * $ratio);
        } elseif (tep_not_null($width) && empty($height)) {
          $ratio = $width / $image_size[0];
          $height = intval($image_size[1] * $ratio);
        } elseif (empty($width) && empty($height)) {
          $width = $image_size[0];
          $height = $image_size[1];
        }
      }
    }

    if (tep_not_null($width) && tep_not_null($height)) {
      $image .= ' width="' . tep_output_string($width) . '" height="' . tep_output_string($height) . '"';
    }

    if (tep_not_null($parameters)) $image .= ' ' . $parameters;

    $image .= '>';

    return $image;
  }

////
// The HTML form submit button wrapper function
// Outputs a button in the selected language
 function tep_image_submit($image, $alt = '', $parameters = '') {
    global $language;

    if(is_file(DIR_WS_TEMPLATES . $language. '/images/buttons/' . $image)) {
        $image_submit = '<input type="image" src="' .
            tep_output_string(DIR_WS_TEMPLATES . $language. '/images/buttons/' . $image) . '" class="img" alt="' . tep_output_string($alt) . '"';
    } else {
        $image_submit = '<input type="image" src="' . tep_output_string(DIR_WS_LANGUAGES . $language . '/images/buttons/' . $image) . '" class="img" alt="' . tep_output_string($alt) . '"';
    }

    if (tep_not_null($alt)) $image_submit .= ' title=" ' . tep_output_string($alt) . ' "';

    if (tep_not_null($parameters)) $image_submit .= ' ' . $parameters;

    $image_submit .= '>';

    return $image_submit;
  }

////
// Output a function button in the selected language
  function tep_image_button($image, $alt = '', $parameters = '') {
    global $language;
    if(is_file(DIR_WS_TEMPLATES . $language .'/images/buttons/' . $image)) {
        return tep_image(DIR_WS_TEMPLATES . $language .'/images/buttons/' . $image, $alt, '', '', $parameters);
    } else {
        return tep_image(DIR_WS_LANGUAGES . $language . '/images/buttons/' . $image, $alt, '', '', $parameters);
    }
  }

////
// Output a separator either through whitespace, or with an image
  function tep_draw_separator($image = 'pixel_black.gif', $width = '100%', $height = '1') {
    if(is_file(DIR_WS_TEMPLATES . 'images/icons/' . $image)) {
	  return tep_image(DIR_WS_TEMPLATES . 'images/icons/' . $image, '', $width, $height);	
	} else {
      return tep_image(DIR_WS_IMAGES . 'icons/' . $image, '', $width, $height);
	}
  }

////
// Output a form
  function tep_draw_form($name, $action, $method = 'post', $parameters = '', $tokenize = false) {
    global $sessiontoken;
    $form = '<form name="' . tep_output_string($name) . '" action="' . tep_output_string($action) . '" method="' . tep_output_string($method) . '"';

    if (tep_not_null($parameters)) $form .= ' ' . $parameters;

    $form .= '>';

    if ( ($tokenize == true) && isset($sessiontoken) ) {
      $form .= '<input type="hidden" name="formid" value="' . tep_output_string($sessiontoken) . '">';
    }

    return $form;
  }

////
// Output a form input field
  function tep_draw_input_field($name, $value = '', $parameters = '', $type = 'text', $reinsert_value = true) {
    global $_GET, $_POST;

    $field = '<input type="' . tep_output_string($type) . '" name="' . tep_output_string($name) . '"';

    if ( ($reinsert_value == true) && ( (isset($_GET[$name]) && is_string($_GET[$name])) || (isset($_POST[$name]) && is_string($_POST[$name])) ) ) {
      if (isset($_GET[$name]) && is_string($_GET[$name])) {
        $value = stripslashes($_GET[$name]);
      } elseif (isset($_POST[$name]) && is_string($_POST[$name])) {
        $value = stripslashes($_POST[$name]);
      }
    }

    if (tep_not_null($value)) {
      $field .= ' value="' . tep_output_string($value) . '"';
    }

    if (tep_not_null($parameters)) $field .= ' ' . $parameters;

    $field .= 'class="input-style">';

    return $field;
  }

////
// Output a form password field
  function tep_draw_password_field($name, $value = '', $parameters = 'maxlength="40"') {
    return tep_draw_input_field($name, $value, $parameters, 'password', false);
  }

////
// Output a form password field with strength tester
  function tep_draw_password_field_st($name, $value = '', $parameters = 'maxlength="40" id="password_st"') {
    return tep_draw_input_field($name, $value, $parameters, 'password', false);
  }

////
// Output a selection field - alias function for tep_draw_checkbox_field() and tep_draw_radio_field()
  function tep_draw_selection_field($name, $type, $value = '', $checked = false, $parameters = '') {
    global $_GET, $_POST;

    $selection = '<input type="' . tep_output_string($type) . '" name="' . tep_output_string($name) . '"';

    if (tep_not_null($value)) $selection .= ' value="' . tep_output_string($value) . '"';

	if ( ($checked == true) || (isset($_GET[$name]) && is_string($_GET[$name]) && (($_GET[$name] == 'on') || (stripslashes($_GET[$name]) == $value))) || (isset($_POST[$name]) && is_string($_POST[$name]) && (($_POST[$name] == 'on') || (stripslashes($_POST[$name]) == $value))) /* added for checkbox fields */ || (isset($_GET[rtrim($name, '[]')]) && is_array($_GET[rtrim($name, '[]')]) && in_array($value, $_GET[rtrim($name, '[]')])) || (isset($_POST[rtrim($name, '[]')]) && is_array($_POST[rtrim($name, '[]')]) && in_array($value, $_POST[rtrim($name, '[]')])) /* end checkbox addition */ ) {
//Line edited above for Product Extra Fields
//    if ( ($checked == true) || (isset($_GET[$name]) && is_string($_GET[$name]) && (($_GET[$name] == 'on') || (stripslashes($_GET[$name]) == $value))) || (isset($_POST[$name]) && is_string($_POST[$name]) && (($_POST[$name] == 'on') || (stripslashes($_POST[$name]) == $value))) ) {
      $selection .= ' CHECKED';
    }

    if (tep_not_null($parameters)) $selection .= ' ' . $parameters;

    $selection .= '>';

    return $selection;
  }

////
// Output a form checkbox field
  function tep_draw_checkbox_field($name, $value = '', $checked = false, $parameters = '') {
    return tep_draw_selection_field($name, 'checkbox', $value, $checked, $parameters);
  }

////
// Output a form radio field
  function tep_draw_radio_field($name, $value = '', $checked = false, $parameters = '') {
    return tep_draw_selection_field($name, 'radio', $value, $checked, $parameters);
  }

////
// Output a form textarea field
  function tep_draw_textarea_field($name, $width, $height, $text = '', $parameters = '', $reinsert_value = true) {
    global $_GET, $_POST;

    $field = '<textarea name="' . tep_output_string($name) . '" cols="' . tep_output_string($width) . '" rows="' . tep_output_string($height) . '"';

    if (tep_not_null($parameters)) $field .= ' ' . $parameters;

    $field .= '>';

    if ( ($reinsert_value == true) && ( (isset($_GET[$name]) && is_string($_GET[$name])) || (isset($_POST[$name]) && is_string($_POST[$name])) ) ) {
      if (isset($_GET[$name]) && is_string($_GET[$name])) {
        $field .= tep_output_string_protected(stripslashes($_GET[$name]));
      } elseif (isset($_POST[$name]) && is_string($_POST[$name])) {
        $field .= tep_output_string_protected(stripslashes($_POST[$name]));
      }
    } elseif (tep_not_null($text)) {
      $field .= tep_output_string_protected($text);
    }

    $field .= '</textarea>';

    return $field;
  }

////
// Output a form hidden field
  function tep_draw_hidden_field($name, $value = '', $parameters = '') {
    global $_GET, $_POST;

    $field = '<input type="hidden" name="' . tep_output_string($name) . '"';

    if (tep_not_null($value)) {
      $field .= ' value="' . tep_output_string($value) . '"';
    } elseif ( (isset($_GET[$name]) && is_string($_GET[$name])) || (isset($_POST[$name]) && is_string($_POST[$name])) ) {
      if ( (isset($_GET[$name]) && is_string($_GET[$name])) ) {
        $field .= ' value="' . tep_output_string(stripslashes($_GET[$name])) . '"';
      } elseif ( (isset($_POST[$name]) && is_string($_POST[$name])) ) {
        $field .= ' value="' . tep_output_string(stripslashes($_POST[$name])) . '"';
      }
    }

    if (tep_not_null($parameters)) $field .= ' ' . $parameters;

    $field .= '>';

    return $field;
  }

////
// Hide form elements
  function tep_hide_session_id() {
    global $session_started, $SID;

    if (($session_started == true) && tep_not_null($SID)) {
      return tep_draw_hidden_field(tep_session_name(), tep_session_id());
    }
  }

////
// Output a form pull down menu
  function tep_draw_pull_down_menu($name, $values, $default = '', $parameters = '', $required = false) {
    global $_GET, $_POST;

    $field = '<select name="' . tep_output_string($name) . '"';

    if (tep_not_null($parameters)) $field .= ' ' . $parameters;

    $field .= '>';

    if (empty($default) && ( (isset($_GET[$name]) && is_string($_GET[$name])) || (isset($_POST[$name]) && is_string($_POST[$name])) ) ) {
      if (isset($_GET[$name]) && is_string($_GET[$name])) {
        $default = stripslashes($_GET[$name]);
      } elseif (isset($_POST[$name]) && is_string($_POST[$name])) {
        $default = stripslashes($_POST[$name]);
      }
    }

    for ($i=0, $n=sizeof($values); $i<$n; $i++) {
      $field .= '<option value="' . tep_output_string($values[$i]['id']) . '"';
      if ($default == $values[$i]['id']) {
        $field .= ' SELECTED';
      }

      $field .= '>' . tep_output_string($values[$i]['text'], array('"' => '&quot;', '\'' => '&#039;', '<' => '&lt;', '>' => '&gt;')) . '</option>';
    }
    $field .= '</select>';

    if ($required == true) $field .= TEXT_FIELD_REQUIRED;

    return $field;
  }

////
// Creates a pull-down list of countries
  function tep_get_country_list($name, $selected = '', $parameters = '') {
    $countries_array = array(array('id' => '', 'text' => PULL_DOWN_DEFAULT));
    $countries = tep_get_countries();

    for ($i=0, $n=sizeof($countries); $i<$n; $i++) {
      $countries_array[] = array('id' => $countries[$i]['countries_id'], 'text' => $countries[$i]['countries_name']);
    }

    return tep_draw_pull_down_menu($name, $countries_array, $selected, $parameters);
  }

////
// remove duplicate content with canonical tag by Spooks 12/2009
function CanonicalLink( $xhtml = false , $ssl = 'SSL' ) {
global $request_type;
$rem_index = false; // Set to true to additionally remove index.php from the uri
$close_tag = ( false === $xhtml ? ' >' : ' />' ); $spage = '';
$domain = ( $request_type == 'SSL' && $ssl == 'SSL' ? HTTPS_SERVER : HTTP_SERVER ); // gets the base URI

// Find the file basename safely = PHP_SELF is unreliable - SCRIPT_NAME can show path to phpcgi
	if ( array_key_exists( 'SCRIPT_NAME', $_SERVER ) 
			&& ( substr( basename( $_SERVER['SCRIPT_NAME'] ), -4, 4 ) == '.php' ) ) {
			$basefile = basename( $_SERVER['SCRIPT_NAME'] );
	} elseif ( array_key_exists( 'PHP_SELF', $_SERVER )
			&& ( substr( basename( $_SERVER['PHP_SELF'] ), -4, 4 ) == '.php' ) ) {
			$basefile = basename( $_SERVER['PHP_SELF'] );
	} else {
	// No base file so we have to return nothing
	return false;
	}
// Don't produce canonicals for SSL pages that bots shouldn't see
$ignore_array = array( 'account', 'address', 'checkout', 'login', 'password', 'logoff' );
// partial match to ssl filenames
	foreach ( $ignore_array as $value ) {
		$spage .= '(' . $value . ')|';
	}
	$spage = rtrim($spage,'|');	
	if (preg_match("/$spage/", $basefile)) return false;
	
// REQUEST_URI usually doesn't exist on Windows servers ( sometimes ORIG_PATH_INFO doesn't either )
	if ( array_key_exists( 'REQUEST_URI', $_SERVER ) ) {
			$request_uri = $_SERVER['REQUEST_URI'];
	} elseif( array_key_exists( 'ORIG_PATH_INFO', $_SERVER ) ) {
			$request_uri = $_SERVER['ORIG_PATH_INFO'];
	} else {
// we need to fail here as we have no REQUEST_URI and return no canonical link html
	return false;
	}	
$remove_array = array( 'currency','language','main_page','page','sort','ref','affiliate_banner_id','max','pto','pfrom','gridlist');	
// Add to this array any additional params you need to remove in the same format as the existing

	$page_remove_array = array(FILENAME_PRODUCT_INFO => array('manufacturers_id', 'cPath'),
			          FILENAME_DEFAULT	     => array() );
								
// remove page specific params, should be in same format as previous, given is manufacturers_id & cPath 
// have to be removed in product_info.php only

	if (is_array(isset($page_remove_array[$basefile]))) $remove_array = array_merge($remove_array, $page_remove_array[$basefile]);
	
	foreach ( $remove_array as $value ) {
			$search[] = '/&*' . $value . '[=\/]+[\w%..\+]*\/?/i';
	}
	$search[] = ('/&*osCsid.*/'); $search[] = ('/\?\z/');	
	if ($rem_index) $search[] = ('/index.php\/*/');	
	$request_uri = preg_replace('/\?&/', '?', preg_replace($search, '', $request_uri )); 	
 
	echo '<link rel="canonical" href="' . $domain . $request_uri . '"' . $close_tag . PHP_EOL;  
} 
////

?>