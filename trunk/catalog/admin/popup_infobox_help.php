<?php
/*
$Id: popup_infobox_help.php 3 2006-05-27 04:59:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  //$navigation->remove_current_page();

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_POPUP_INFOBOX_HELP);

?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<style type="text/css"><!--
a { color:#080381; text-decoration:none; }
a:hover { color:#aabbdd; text-decoration:underline; }
a.text:link, a.text:visited { color: #000000; text-decoration: none; }
a:text:hover { color: #000000; text-decoration: underline; }



.smallText { font-family: Verdana, Arial, sans-serif; font-size: 10px; }
/* info box */
.infoBoxHeading { font-family: Verdana, Arial, sans-serif; font-size: 11px; color: #ffffff; background-color: #B3BAC5; }
.infoBoxContent { font-family: Verdana; font-size: 10pt; border: 1px outset #9B9B9B; 
               padding-left: 4; padding-right: 4; padding-top: 1; 
               padding-bottom: 1; background-color: #FFFFFF }
//--></style>
<body marginwidth="10" marginheight="10" topmargin="10" bottommargin="10" leftmargin="10" rightmargin="10" bgcolor="#DEE4E8">

<?php
  $heading = array();
  $contents = array();

    switch ($HTTP_GET_VARS['action']) {

      case 'filename':
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_NEW_INFOBOX . '</b>');
      $contents[] = array('text'  => TEXT_INFOBOX_HELP_FILENAME);
      break;

      case 'heading':
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_NEW_INFOBOX . '</b>');
      $contents[] = array('text'  => TEXT_INFOBOX_HELP_HEADING);
      break;

      case 'define':
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_NEW_INFOBOX . '</b>');
      $contents[] = array('text'  => TEXT_INFOBOX_HELP_DEFINE);
      break;

      case 'column':
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_NEW_INFOBOX . '</b>');
      $contents[] = array('text'  => TEXT_INFOBOX_HELP_COLUMN);
      break;

      case 'position':
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_NEW_INFOBOX . '</b>');
      $contents[] = array('text'  => TEXT_INFOBOX_HELP_POSITION);
      break;

      case 'active':
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_NEW_INFOBOX . '</b>');
      $contents[] = array('text'  => TEXT_INFOBOX_HELP_ACTIVE);
      break;

    }
 $box = new box;
  echo $box->infoBox($heading, $contents);



?>

<p class="smallText" align="right"><?php echo '<a href="javascript:window.close()">' . TEXT_CLOSE_WINDOW . '</a>'; ?></p>


</body>

</html>