<?php
/*
$Id: html_output.php 14 2006-07-28 17:42:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax

  Released under the GNU General Public License
*/

// BOF: MOD - Ultimate SEO URLs - by Chemo
  function implode_assoc($array, $inner_glue='=', $outer_glue='&') {
    $output = array();
    foreach( $array as $key => $item )
    $output[] = $key . $inner_glue . $item;
  
    return implode($outer_glue, $output);
  }
  
  function short_name($str, $limit=3){
    if (defined('SEO_URLS_FILTER_SHORT_WORDS')) $limit = SEO_URLS_FILTER_SHORT_WORDS;
    $foo = explode('-', $str);
    foreach($foo as $index => $value){
      switch (true){
        case ( strlen($value) <= $limit ):
          continue;
        default:
          $container[] = $value;
          break;
      }
    } # end foreach
    $container = ( sizeof($container) > 1 ? implode('-', $container) : $str );
    return $container;
  }
// EOF: MOD - Ultimate SEO URLs - by Chemo

////
// The HTML href link wrapper function
  function tep_href_link($page = '', $parameters = '', $connection = 'NONSSL', $add_session_id = true, $search_engine_safe = true) {
    global $request_type, $session_started, $SID;

// BOF: MOD - Ultimate SEO URLs - by Chemo
    $seo = ( defined('SEO_URLS') ? SEO_URLS : false );
    $seo_rewrite_type = ( defined('SEO_URLS_TYPE') ? SEO_URLS_TYPE : false );
    $seo_pages = array('index.php', 'product_info.php');
    if ( !in_array($page, $seo_pages) ) $seo = false;
// EOF: MOD - Ultimate SEO URLs - by Chemo

    if (!tep_not_null($page)) {
      die('</td></tr></table></td></tr></table><br><br><font color="#ff0000"><b>Error!</b></font><br><br><b>Unable to determine the page link!<br><br>');
    }

// BOF: MOD - Ultimate SEO URLs - by Chemo
    if ($page == '/') $page = '';
// EOF: MOD - Ultimate SEO URLs - by Chemo

    if ($connection == 'NONSSL') {
      $link = HTTP_SERVER . DIR_WS_HTTP_CATALOG;
// BOF: MOD - Ultimate SEO URLs - by Chemo
    $seo_link = HTTP_SERVER . DIR_WS_HTTP_CATALOG;
    $seo_rewrite_link = HTTP_SERVER . DIR_WS_HTTP_CATALOG;
// EOF: MOD - Ultimate SEO URLs - by Chemo
    } elseif ($connection == 'SSL') {
      if (ENABLE_SSL == true) {
        $link = HTTPS_SERVER . DIR_WS_HTTPS_CATALOG;
// BOF: MOD - Ultimate SEO URLs - by Chemo
        $seo_link = HTTPS_SERVER . DIR_WS_HTTPS_CATALOG;
        $seo_rewrite_link = HTTPS_SERVER . DIR_WS_HTTPS_CATALOG;
// EOF: MOD - Ultimate SEO URLs - by Chemo
      } else {
        $link = HTTP_SERVER . DIR_WS_HTTP_CATALOG;
// BOF: MOD - Ultimate SEO URLs - by Chemo
        $seo_link = HTTP_SERVER . DIR_WS_HTTP_CATALOG;
        $seo_rewrite_link = HTTP_SERVER . DIR_WS_HTTP_CATALOG;
// EOF: MOD - Ultimate SEO URLs - by Chemo
      }
    } else {
      die('</td></tr></table></td></tr></table><br><br><font color="#ff0000"><b>Error!</b></font><br><br><b>Unable to determine connection method on a link!<br><br>Known methods: NONSSL SSL</b><br><br>');
    }

    if (tep_not_null($parameters)) {
      $link .= $page . '?' . tep_output_string($parameters);
      $separator = '&';

// BOF: MOD - Ultimate SEO URLs - by Chemo
# Start exploding the parameters to extract the values
# Also, we could use parse_str($parameters) and would probably be more clean
      if ($seo == 'true'){
        $p = explode('&', $parameters);
        krsort($p);
        $params = array();

        if ( $seo_rewrite_type == 'Rewrite' ){
          foreach ($p as $index => $valuepair) {
            $p2 = explode('=', $valuepair);
            switch ($p2[0]){
              case 'products_id':
                $rewrite_product = true;
                if ( defined('PRODUCT_NAME_'.$p2[1]) ){
                  $rewrite_page_product = short_name(constant('PRODUCT_NAME_'.$p2[1])) . '-p-' . $p2[1] . '.html';
                } else { $seo = false; }
              break;

              case 'cPath':
                $rewrite_category = true;
                if ( defined('CATEGORY_NAME_'.$p2[1]) ){
                  $rewrite_page_category = short_name(constant('CATEGORY_NAME_'.$p2[1])) . '-c-' . $p2[1] . '.html';
                } else { $seo = false; }
              break;

// manufacturer addition by WebPixie
              case 'manufacturers_id':
                $rewrite_manufacturer = true;
                if ( defined('MANUFACTURER_NAME_'.$p2[1]) ){
                  $rewrite_page_manufacturer = short_name(constant('MANUFACTURER_NAME_'.$p2[1])) . '-m-' . $p2[1] . '.html';
                } else { $seo = false; }
              break;
// end manufacturer addition by WebPixie

              default:
                $params[$p2[0]] = $p2[1];
              break;
            } # switch
          } # end foreach
          $params_stripped = implode_assoc($params);
          switch (true){
            case ( $rewrite_product && $rewrite_category ):
            case ( $rewrite_product ):
              $rewrite_page = $rewrite_page_product;
              $rewrite_category = false;
            break;
            case ( $rewrite_category ):
              $rewrite_page = $rewrite_page_category;
            break;
// manufacturer addition by WebPixie
            case ( $rewrite_manufacturer ):
              $rewrite_page = $rewrite_page_manufacturer;
            break;
// end manufacturer addition by WebPixie
            default:
              $seo = false;
            break;
          } #end switch true
        $seo_rewrite_link .= $rewrite_page . ( tep_not_null($params_stripped) ? '?'.tep_output_string($params_stripped) : '' );
        $separator = ( tep_not_null($params_stripped) ? '&' : '?' );
        } else {
          foreach ($p as $index => $valuepair) {
            $p2 = explode('=', $valuepair);
            switch ($p2[0]){
              case 'products_id':
                if ( defined('PRODUCT_NAME_'.$p2[1]) ){
                  $params['pName'] = constant('PRODUCT_NAME_'.$p2[1]);
                } else { $seo = false; }
              break;
  
              case 'cPath':
                if ( defined('CATEGORY_NAME_'.$p2[1]) ){
                  $params['cName'] = constant('CATEGORY_NAME_'.$p2[1]);
                } else { $seo = false; }
              break;
  
  // manufacturer addition by WebPixie
              case 'manufacturers_id':
                if ( defined('MANUFACTURER_NAME_'.$p2[1]) ){
                  $params['mName'] = constant('MANUFACTURER_NAME_'.$p2[1]);
                } else { $seo = false; }
              break;
  // end manufacturer addition by WebPixie
  
              default:
                $params[$p2[0]] = $p2[1];
              break;
            } # switch
          } # end foreach
          $params_stripped = implode_assoc($params);
          $seo_link .= $page . '?'.tep_output_string($params_stripped);
          $separator = '&';
        } # end if/else
      } # end if $seo
// EOF: MOD - Ultimate SEO URLs - by Chemo
    } else {
      $link .= $page;
      $separator = '?';
// BOF: MOD - Ultimate SEO URLs - by Chemo
//  }
      $seo = false;
    } # end if(tep_not_null($parameters)
// EOF: MOD - Ultimate SEO URLs - by Chemo

    while ( (substr($link, -1) == '&') || (substr($link, -1) == '?') ) $link = substr($link, 0, -1);

// Add the session ID when moving from different HTTP and HTTPS servers, or when SID is defined
    if ( ($add_session_id == true) && ($session_started == true) && (SESSION_FORCE_COOKIE_USE == 'False') ) {
      if (tep_not_null($SID)) {
        $_sid = $SID;
      } elseif ( ( ($request_type == 'NONSSL') && ($connection == 'SSL') && (ENABLE_SSL == true) ) || ( ($request_type == 'SSL') && ($connection == 'NONSSL') ) ) {
        if (HTTP_COOKIE_DOMAIN != HTTPS_COOKIE_DOMAIN) {
          $_sid = tep_session_name() . '=' . tep_session_id();
        }
      }
    }

    if ( (SEARCH_ENGINE_FRIENDLY_URLS == 'true') && ($search_engine_safe == true) ) {
      while (strstr($link, '&&')) $link = str_replace('&&', '&', $link);
// LINE ADDED: MOD - Ultimate SEO URLs - by Chemo
      while (strstr($seo_link, '&&')) $seo_link = str_replace('&&', '&', $seo_link);

      $link = str_replace('?', '/', $link);
      $link = str_replace('&', '/', $link);
      $link = str_replace('=', '/', $link);
// BOF: MOD - Ultimate SEO URLs - by Chemo
      $seo_link = str_replace('?', '/', $seo_link);
      $seo_link = str_replace('&', '/', $seo_link);
      $seo_link = str_replace('=', '/', $seo_link);
      $seo_rewrite_link = str_replace('?', '/', $seo_rewrite_link);
      $seo_rewrite_link = str_replace('&', '/', $seo_rewrite_link);
      $seo_rewrite_link = str_replace('=', '/', $seo_rewrite_link);
// EOF: MOD - Ultimate SEO URLs - by Chemo

      $separator = '?';
    }

// BOF: MOD - Ultimate SEO URLs - by Chemo
//  if (isset($_sid)) {
//    $link .= $separator . $_sid;
//  }
//    return $link;
    if (!tep_session_is_registered('customer_id') && ENABLE_PAGE_CACHE == 'true' && class_exists('page_cache')) {
      $link .= $separator . '<osCsid>';
      $seo_link .= $separator . '<osCsid>';
      $seo_rewrite_link .= $separator . '<osCsid>';
    } elseif (isset($_sid)) {
// LINES CHANGED: MS2 update 501112 - Added tep_output_string(...)
      $link .= $separator . tep_output_string($_sid);
      $seo_link .= $separator . tep_output_string($_sid);
      $seo_rewrite_link .= $separator . tep_output_string($_sid);
    }

    if ($seo == 'true') {
      return ($seo_rewrite_type == 'Rewrite' ? $seo_rewrite_link : $seo_link);
    } else {
      return $link;
    }
// EOF: MOD - Ultimate SEO URLs - by Chemo
  }

////
// The HTML image wrapper function
  function tep_image($src, $alt = '', $width = '', $height = '', $parameters = '') {
    if ( (empty($src) || ($src == DIR_WS_IMAGES)) && (IMAGE_REQUIRED == 'false') ) {
      return false;
    }

// alt is added to the img tag even if it is null to prevent browsers from outputting
// the image filename as default
    $image = '<img src="' . tep_output_string($src) . '" border="0" alt="' . tep_output_string($alt) . '"';

    if (tep_not_null($alt)) {
      $image .= ' title=" ' . tep_output_string($alt) . ' "';
    }

    if ( (CONFIG_CALCULATE_IMAGE_SIZE == 'true') && (empty($width) || empty($height)) ) {
      if ($image_size = @getimagesize($src)) {
        if (empty($width) && tep_not_null($height)) {
          $ratio = $height / $image_size[1];
          $width = $image_size[0] * $ratio;
        } elseif (tep_not_null($width) && empty($height)) {
          $ratio = $width / $image_size[0];
          $height = $image_size[1] * $ratio;
        } elseif (empty($width) && empty($height)) {
          $width = $image_size[0];
          $height = $image_size[1];
        }
      } elseif (IMAGE_REQUIRED == 'false') {
        return false;
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

    $image_submit = '<input type="image" src="' . tep_output_string(DIR_WS_LANGUAGES . $language . '/images/buttons/' . $image) . '" border="0" alt="' . tep_output_string($alt) . '"';

    if (tep_not_null($alt)) $image_submit .= ' title=" ' . tep_output_string($alt) . ' "';

    if (tep_not_null($parameters)) $image_submit .= ' ' . $parameters;

    $image_submit .= '>';

    return $image_submit;
  }

////
// Output a function button in the selected language
  function tep_image_button($image, $alt = '', $parameters = '') {
    global $language;

    return tep_image(DIR_WS_LANGUAGES . $language . '/images/buttons/' . $image, $alt, '', '', $parameters);
  }

////
// Output a separator either through whitespace, or with an image
  function tep_draw_separator($image = 'pixel_black.gif', $width = '100%', $height = '1') {
    return tep_image(DIR_WS_IMAGES . $image, '', $width, $height);
  }

////
// Output a form
  function tep_draw_form($name, $action, $method = 'post', $parameters = '') {
    $form = '<form name="' . tep_output_string($name) . '" action="' . tep_output_string($action) . '" method="' . tep_output_string($method) . '"';

    if (tep_not_null($parameters)) $form .= ' ' . $parameters;

    $form .= '>';

    return $form;
  }

////
// Output a form input field
  function tep_draw_input_field($name, $value = '', $parameters = '', $type = 'text', $reinsert_value = true) {
    $field = '<input type="' . tep_output_string($type) . '" name="' . tep_output_string($name) . '"';

    if ( (isset($GLOBALS[$name])) && ($reinsert_value == true) ) {
      $field .= ' value="' . tep_output_string(stripslashes($GLOBALS[$name])) . '"';
    } elseif (tep_not_null($value)) {
      $field .= ' value="' . tep_output_string($value) . '"';
    }

    if (tep_not_null($parameters)) $field .= ' ' . $parameters;

    $field .= '>';

    return $field;
  }

////
// Output a form password field
  function tep_draw_password_field($name, $value = '', $parameters = 'maxlength="40"') {
    return tep_draw_input_field($name, $value, $parameters, 'password', false);
  }

////
// Output a selection field - alias function for tep_draw_checkbox_field() and tep_draw_radio_field()
  function tep_draw_selection_field($name, $type, $value = '', $checked = false, $parameters = '') {
    $selection = '<input type="' . tep_output_string($type) . '" name="' . tep_output_string($name) . '"';

    if (tep_not_null($value)) $selection .= ' value="' . tep_output_string($value) . '"';

    if ( ($checked == true) || ( isset($GLOBALS[$name]) && is_string($GLOBALS[$name]) && ( ($GLOBALS[$name] == 'on') || (isset($value) && (stripslashes($GLOBALS[$name]) == $value)) ) ) ) {
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
  function tep_draw_textarea_field($name, $wrap, $width, $height, $text = '', $parameters = '', $reinsert_value = true) {
    $field = '<textarea name="' . tep_output_string($name) . '" wrap="' . tep_output_string($wrap) . '" cols="' . tep_output_string($width) . '" rows="' . tep_output_string($height) . '"';

    if (tep_not_null($parameters)) $field .= ' ' . $parameters;

    $field .= '>';

    if ( (isset($GLOBALS[$name])) && ($reinsert_value == true) ) {
// LINE CHANGED: MS2 update 501112 - Added: tep_output_string_protected(...)
      $field .= tep_output_string_protected(stripslashes($GLOBALS[$name]));
    } elseif (tep_not_null($text)) {
// LINE CHANGED: MS2 update 501112 - Added: tep_output_string_protected(...)
      $field .= tep_output_string_protected($text);
    }

    $field .= '</textarea>';

    return $field;
  }

////
// Output a form hidden field
  function tep_draw_hidden_field($name, $value = '', $parameters = '') {
    $field = '<input type="hidden" name="' . tep_output_string($name) . '"';

    if (tep_not_null($value)) {
      $field .= ' value="' . tep_output_string($value) . '"';
    } elseif (isset($GLOBALS[$name])) {
      $field .= ' value="' . tep_output_string(stripslashes($GLOBALS[$name])) . '"';
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
    $field = '<select name="' . tep_output_string($name) . '"';

    if (tep_not_null($parameters)) $field .= ' ' . $parameters;

    $field .= '>';

    if (empty($default) && isset($GLOBALS[$name])) $default = stripslashes($GLOBALS[$name]);

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
?>
