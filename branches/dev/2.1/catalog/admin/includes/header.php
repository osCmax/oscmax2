<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js"></script>
<link type="text/css" href="includes/javascript/jquery-ui-1.7.2.custom.css" rel="Stylesheet" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>

<script type="text/javascript" src="includes/javascript/hoverIntent.js"></script>
<script type="text/javascript" src="includes/javascript/superfish.js"></script>
<script type="text/javascript" src="includes/javascript/supersubs.js"></script>
<link rel="stylesheet" type="text/css" href="includes/javascript/superfish.css">

<script type="text/javascript" src="includes/javascript/jquery.cluetip.min.js" ></script>
<link rel="stylesheet" type="text/css" href="includes/javascript/jquery.cluetip.css" >


<script type="text/javascript"> 
// initialise Superfish & jQuery UI Tabs

    $(document).ready(function(){ 
        $("ul.sf-menu").supersubs({ 
            minWidth:    12,   // minimum width of sub-menus in em units 
            maxWidth:    27,   // maximum width of sub-menus in em units 
            extraWidth:  1     // extra width can ensure lines don't sometimes turn over 
                               // due to slight rounding differences and font-family 
        }).superfish();  // call supersubs first, then superfish, so that subs are 
                         // not display:none when measuring. Call before initialising 
                         // containing tabs for same reason. 
// Tabs
    $("#searchtabs").tabs();
    $("#tabs").tabs();

    $("#descriptiontabs0").tabs();
	$("#descriptiontabs1").tabs();
	$("#descriptiontabs2").tabs();
	$("#descriptiontabs3").tabs();
	$("#descriptiontabs4").tabs();
	$("#descriptiontabs5").tabs();

	$("#languagetabs").tabs();
	$("#authortabs").tabs();
	$("#articletabs").tabs();

    $('span[title]').cluetip({splitTitle: '|', arrows: true, dropShadow: false, cluetipClass: 'jtip'});


<!--//Tabs for QPBPP for SPPC -->
/* Tabs for Languages */
    $("#langtabs").tabs();
/* Tabs for Customer Groups */
    $("#qpbpp").tabs();

}); 

</script>
<script language="javascript" type="text/javascript">
<!--
function setMessage() {
var newmessage = document.status.responses.value;
document.status.comments.value += newmessage;
}
//-->
</script>
<?php
/*
$Id: header.php 3 2006-05-27 04:59:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax2005 osCMax, 2002 osCommerce

  Released under the GNU General Public License
*/

  if ($messageStack->size > 0) {
    echo $messageStack->output();
  }
  
  $languages = tep_get_languages();
  $languages_array = array();
  $languages_selected = DEFAULT_LANGUAGE;
  for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
    $languages_array[] = array('id' => $languages[$i]['code'],
                               'text' => $languages[$i]['name']);
    if ($languages[$i]['directory'] == $language) {
      $languages_selected = $languages[$i]['code'];
    }
  }
  
?>
<?php
  $my_userid_query = tep_db_query ("select a.admin_id, a.admin_username, g.admin_groups_name from " . TABLE_ADMIN . " a, " . TABLE_ADMIN_GROUPS . " g where a.admin_id= " . $login_id . " and g.admin_groups_id= " . $login_groups_id . "");
  $myLogin = tep_db_fetch_array($my_userid_query);
?>

<table border="0" width="100%" cellspacing="0" cellpadding="0" bgcolor="#F0F1F1">
<tr valign="top">
  <td width="33%" align="left"><a href="http://www.oscmax.com/" target="_blank" class="header"><?php echo tep_image(DIR_WS_IMAGES .'oscmax-logo.png'); ?></a></td>
  <td width="33%" align="center">
    <table width="236">
      <tr>
        <td class="smalltext" align="center">
            <div id="searchtabs" class="ui-tabs">
                <ul>
                <li><a href="#searchtabs-1">Customers</a></li>
                <li><a href="#searchtabs-2">Products</a></li>
                <li><a href="#searchtabs-3">Orders</a></li>
                </ul>
    
                <div id="searchtabs-1" class="ui-tabs-hide">Search: <?php echo tep_draw_form('search', FILENAME_CUSTOMERS, '', 'get') . tep_draw_input_field('search') . tep_hide_session_id(); ?></form></div>
                
                <div id="searchtabs-2" class="ui-tabs-hide">Search: <?php echo tep_draw_form('search', FILENAME_CATEGORIES, '', 'get') . tep_draw_input_field('search') . tep_hide_session_id(); ?></form></div>
                
                <div id="searchtabs-3" class="ui-tabs-hide">Search: <?php echo tep_draw_form('search', FILENAME_ORDERS, '', 'get') . tep_draw_input_field('q', '', $orderparams, false, '', false) . tep_draw_input_field('action', 'edit', '', false, 'hidden', false); ?></form></div>
           
            </div>
	    </td>
	  </tr>
    </table>
  </td>
  <td width="33%" class="smalltext" align="right">
  
  <?php
$current_page = basename($_SERVER['SCRIPT_FILENAME']);

//Could be extended to language specific help documents
//$help_pages_query_raw = tep_db_query ("select current_page, help_page, help_page_title, language from " . TABLE_HELP_PAGES . " where current_page = '" . tep_db_input($current_page) . "' and language = '" . (int)$languages[$i]['id'] . "'");
$help_pages_query_raw = tep_db_query ("select current_page, help_page, help_page_title, language from " . TABLE_HELP_PAGES . " where current_page = '" . tep_db_input($current_page) . "'");


$help_pages_query = tep_db_fetch_array($help_pages_query_raw);

if ($help_pages_query['help_page'] != '' ) {
	echo '<a href="' . $help_pages_query['help_page'] . '" title="' . $help_pages_query['help_page_title'] . '" target="_blank">' . tep_image(DIR_WS_IMAGES . 'icons/help.png', 'Help') . '</a>';
}
?>
  	<?php echo tep_draw_form('languages', 'index.php', '', 'get'); ?>
  	<?php echo tep_draw_pull_down_menu('language', $languages_array, $languages_selected, 'onChange="this.form.submit();"'); ?>
  	<?php echo tep_hide_session_id(); ?></form>

	<?php echo '<a href="' . tep_href_link(FILENAME_ADMIN_ACCOUNT, '', 'SSL') . '" class="header"' . '">'; ?>
	<?php echo tep_image(DIR_WS_ICONS . 'book_key.png', 'Manage Account'); ?> Welcome, <?php echo $myLogin['admin_username']; ?>.</a>
	<?php echo '<a href="' . tep_catalog_href_link('admin/logoff.php') . '" class="header">'; ?>
	<?php echo tep_image(DIR_WS_ICONS . 'exit.png', 'Logoff'); ?> Logoff &nbsp;
  </td>
</tr>
<tr style="background-color:#606060">
  <td colspan="4">
    <?php require(DIR_WS_INCLUDES . 'menu.php'); ?>
  </td>
</tr>
</table>