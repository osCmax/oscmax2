<?php
/*
$Id$

  osCmax e-Commerce
  http://www.osCmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/


require(DIR_WS_INCLUDES . 'meta_tags.php');
//require(DIR_WS_INCLUDES . 'counter.php');

$bts_php_array = bts_read_php();
$bts_html_array = bts_read_html($bts_php_array);

// debug:
// echo print_var($php_code_array_new);
// echo print_var($html_string_array);

// loop the html array and ouput eval'ed php (if a tag is detected) or HTML
foreach ($bts_html_array as $key => $value) {
  if (array_key_exists($value,$bts_php_array)){
    // existing php code tag detected => evaluate php
    eval($bts_php_array[$value]);
  } else {
    // no existing php code tag => it's HTML => echo 
    echo $value;
  }
}

/* functions */
function bts_read_php($php_template = 'main_page.code.php') {
  // read the php file, detecting tags and using these tags as key
  // read the PHP file into array (each line is one array element)
  $file_array = file(DIR_WS_TEMPLATES . $php_template);
  // detect the tags "begin{", and use these tags as key for the new array
  foreach ($file_array as $value){
    if (strpos ($value, 'begin{')){
      // it's a {tag}, strip "//" and clean tag string
      $position = strpos ($value, '{');
      $tag_value = trim(substr ( $value, $position));
    } elseif (isset($tag_value)) {
      // it's php code, save into array using the {tag} as key
      $php_code_array[$tag_value] .= $value;
    }
  }
  
  return $php_code_array;
}

function bts_read_html($php_code_array, $html_template = 'main_page.html') {
  // read the HTML template file and split it up using the tags found in the php file
  // file_get_contents replacement if PHP version is < 4.3
  if(!function_exists('file_get_contents')) {
    function file_get_contents($file) {
      $file = file($file);
      return !$file ? false : implode('', $file);
    }
  }  
  $html = file_get_contents(DIR_WS_TEMPLATES . $html_template);
  // convert the tags array to a string where the tags are separated by "|" 's
  $spit = implode('|', array_keys($php_code_array));
  // split the $html into chunks and save the chunks into an array, HTML and {tags} separated
  $html_array =  preg_split("/($spit)/",$html,-1,PREG_SPLIT_DELIM_CAPTURE);
  
  return $html_array;
}

?>